import React, { useState, useRef, useCallback } from 'react'
import { useNavigate } from 'react-router-dom'
import Webcam from 'react-webcam'
import Tesseract from 'tesseract.js'
import { parse as parseMRZ } from 'mrz'
import {
  Box,
  Container,
  AppBar,
  Toolbar,
  IconButton,
  Typography,
  Button,
  Paper,
  CircularProgress,
  Alert,
  Card,
  CardContent,
  Chip,
  Stack,
} from '@mui/material'
import {
  ArrowBack,
  CameraAlt,
  FlipCameraAndroid,
  CheckCircle,
  RestartAlt,
  Edit,
} from '@mui/icons-material'

export default function ScanDocument() {
  const navigate = useNavigate()
  const webcamRef = useRef(null)
  
  const [facingMode, setFacingMode] = useState('environment') // 'user' or 'environment'
  const [capturedImage, setCapturedImage] = useState(null)
  const [scanning, setScanning] = useState(false)
  const [scanResult, setScanResult] = useState(null)
  const [error, setError] = useState(null)
  const [progress, setProgress] = useState(0)

  // Capture photo from webcam
  const capturePhoto = useCallback(() => {
    const imageSrc = webcamRef.current.getScreenshot()
    if (imageSrc) {
      setCapturedImage(imageSrc)
      setError(null)
    }
  }, [webcamRef])

  // Toggle camera (front/back)
  const toggleCamera = () => {
    setFacingMode((prevMode) => (prevMode === 'user' ? 'environment' : 'user'))
  }

  // Retake photo
  const retakePhoto = () => {
    setCapturedImage(null)
    setScanResult(null)
    setError(null)
    setProgress(0)
  }

  // Preprocess image for better OCR
  const preprocessImage = (imageDataUrl) => {
    return new Promise((resolve) => {
      const canvas = document.createElement('canvas')
      const ctx = canvas.getContext('2d')
      const img = new Image()
      
      img.onload = () => {
        canvas.width = img.width
        canvas.height = img.height
        
        // Draw original image
        ctx.drawImage(img, 0, 0)
        
        // Get image data
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height)
        const data = imageData.data
        
        // Apply contrast and brightness enhancement
        const contrast = 1.5 // Increase contrast
        const brightness = 20 // Increase brightness
        
        for (let i = 0; i < data.length; i += 4) {
          // Apply contrast and brightness to RGB channels
          data[i] = Math.min(255, Math.max(0, contrast * (data[i] - 128) + 128 + brightness))     // Red
          data[i + 1] = Math.min(255, Math.max(0, contrast * (data[i + 1] - 128) + 128 + brightness)) // Green
          data[i + 2] = Math.min(255, Math.max(0, contrast * (data[i + 2] - 128) + 128 + brightness)) // Blue
        }
        
        // Put enhanced image data back
        ctx.putImageData(imageData, 0, 0)
        
        // Return enhanced image as data URL
        resolve(canvas.toDataURL('image/jpeg', 0.95))
      }
      
      img.src = imageDataUrl
    })
  }

  // Process the captured image
  const processImage = async () => {
    if (!capturedImage) return

    setScanning(true)
    setError(null)
    setScanResult(null)
    setProgress(0)

    try {
      setProgress(5)
      console.log('Starting OCR recognition...')
      
      // Preprocess image for better OCR
      console.log('Preprocessing image...')
      const enhancedImage = await preprocessImage(capturedImage)
      setProgress(10)
      
      // Perform OCR with optimized settings
      const { data: { text } } = await Tesseract.recognize(
        enhancedImage,
        'eng',
        {
          logger: (m) => {
            if (m.status === 'recognizing text') {
              setProgress(10 + m.progress * 65)
            }
          },
          tessedit_pageseg_mode: 6, // Assume uniform block of text
          tessedit_char_blacklist: '|`~^',
          preserve_interword_spaces: '1',
        }
      )

      setProgress(75)
      console.log('=== FULL OCR TEXT ===')
      console.log(text)
      console.log('====================')

      let parsedData = null
      let documentType = 'Unknown'
      let confidence = 'Low'

      // Split text into lines for processing
      const allLines = text.split('\n')
      const cleanLines = allLines.map(l => l.trim().replace(/\s+/g, '')).filter(l => l.length > 0)
      
      console.log('Cleaned Lines:', cleanLines)

      // STEP 1: Try MRZ Detection for Passports/IDs
      const mrzLines = cleanLines.filter(line => {
        // Remove non-MRZ characters for checking
        const mrzOnly = line.replace(/[^A-Z0-9<]/g, '')
        // MRZ lines are typically 30-44 characters long
        return mrzOnly.length >= 28 && /[A-Z0-9<]{28,}/.test(mrzOnly)
      })

      console.log('Potential MRZ Lines:', mrzLines)

      if (mrzLines.length >= 2) {
        // Try to parse MRZ with different line combinations
        for (let i = 0; i <= mrzLines.length - 2; i++) {
          try {
            // Clean MRZ lines (remove extra characters)
            const line1 = mrzLines[i].replace(/[^A-Z0-9<]/g, '')
            const line2 = mrzLines[i + 1].replace(/[^A-Z0-9<]/g, '')
            const line3 = mrzLines[i + 2] ? mrzLines[i + 2].replace(/[^A-Z0-9<]/g, '') : ''
            
            let mrzText
            if (line3 && line3.length >= 28) {
              mrzText = `${line1}\n${line2}\n${line3}` // 3-line MRZ (passports)
              console.log('Trying 3-line MRZ:', mrzText)
            } else {
              mrzText = `${line1}\n${line2}` // 2-line MRZ (ID cards)
              console.log('Trying 2-line MRZ:', mrzText)
            }
            
            const mrzResult = parseMRZ(mrzText)
            
            if (mrzResult && mrzResult.valid) {
              console.log('✅ MRZ PARSED SUCCESSFULLY!')
              console.log('MRZ Result:', mrzResult)
              
              documentType = mrzResult.format || 'Passport/ID Card'
              confidence = 'High'
              
              parsedData = {
                documentType,
                documentNumber: mrzResult.fields.documentNumber || '',
                firstName: mrzResult.fields.firstName || '',
                lastName: mrzResult.fields.lastName || '',
                nationality: mrzResult.fields.nationality || '',
                dateOfBirth: formatMRZDate(mrzResult.fields.birthDate),
                sex: mrzResult.fields.sex || '',
                expirationDate: formatMRZDate(mrzResult.fields.expirationDate),
                issuingCountry: mrzResult.fields.issuingState || '',
              }
              
              console.log('Extracted Data:', parsedData)
              break
            }
          } catch (mrzError) {
            console.log('MRZ parse attempt failed:', mrzError.message)
            continue
          }
        }
      }

      // STEP 2: Fallback to OCR pattern matching if MRZ failed
      if (!parsedData) {
        console.log('MRZ detection failed, using OCR pattern matching...')
        parsedData = extractDataFromOCR(text)
        documentType = parsedData ? 'ID Card' : 'Unknown Document'
        confidence = parsedData ? 'Medium' : 'Low'
      }

      setProgress(100)

      if (parsedData) {
        setScanResult({
          ...parsedData,
          documentType,
          confidence,
          rawText: text,
        })
        console.log('✅ Final Scan Result:', { ...parsedData, documentType, confidence })
      } else {
        setError(`Unable to automatically extract data from this document. For better results:

📋 Document Positioning:
• Lay the document flat on a table (avoid holding by hand)
• Fill the camera frame with the document (get closer)
• Keep the document straight (not rotated or tilted)

💡 Lighting & Quality:
• Use bright, even lighting (avoid shadows or glare)
• Ensure all text is sharp and clearly readable
• Clean the camera lens if image appears blurry

🆔 Document Types:
• For ID Cards: Make sure all text fields are visible
• For Passports: Include the machine-readable zone (MRZ) at the bottom
• Avoid damaged or worn documents when possible

📱 Technical Tips:
• Hold the phone steady for 2-3 seconds
• Try landscape orientation for wider documents
• If scanning fails repeatedly, you can manually enter the information

Would you like to try scanning again or proceed with manual entry?`)
        console.log('❌ No data extracted - providing detailed user guidance')
      }

    } catch (err) {
      console.error('❌ Scanning error:', err)
      setError('Failed to scan document. Please ensure the document is clear and well-lit.')
    } finally {
      setScanning(false)
    }
  }

  // Format MRZ date from YYMMDD to YYYY-MM-DD (for HTML date input)
  const formatMRZDate = (dateStr) => {
    if (!dateStr || dateStr.length !== 6) return ''
    
    const year = parseInt(dateStr.substring(0, 2))
    const month = dateStr.substring(2, 4)
    const day = dateStr.substring(4, 6)
    
    // Determine century (50+ = 1900s, <50 = 2000s)
    const fullYear = year > 50 ? 1900 + year : 2000 + year
    
    // Return in YYYY-MM-DD format for date inputs
    return `${fullYear}-${month}-${day}`
  }

  // Helper function to convert various date formats to YYYY-MM-DD
  const convertDateFormat = (dateStr) => {
    if (!dateStr) return ''
    
    // Remove extra spaces and normalize separators
    const cleaned = dateStr.replace(/\s+/g, '').replace(/[.\-]/g, '/')
    
    // Try different date format patterns
    const patterns = [
      /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/, // DD/MM/YYYY or MM/DD/YYYY
      /^(\d{4})\/(\d{1,2})\/(\d{1,2})$/, // YYYY/MM/DD
      /^(\d{1,2})\/(\d{1,2})\/(\d{2})$/,  // DD/MM/YY or MM/DD/YY
    ]
    
    for (const pattern of patterns) {
      const match = cleaned.match(pattern)
      if (match) {
        let [, part1, part2, part3] = match
        
        // Convert 2-digit year to 4-digit
        if (part3.length === 2) {
          part3 = parseInt(part3) > 30 ? '19' + part3 : '20' + part3
        }
        
        // Determine if it's DD/MM/YYYY or MM/DD/YYYY based on context
        // If first part > 12, it's likely DD/MM/YYYY
        if (pattern.source.includes('(\\d{4})')) {
          // YYYY/MM/DD format
          return `${part1}-${part2.padStart(2, '0')}-${part3.padStart(2, '0')}`
        } else if (parseInt(part1) > 12) {
          // DD/MM/YYYY format
          return `${part3}-${part2.padStart(2, '0')}-${part1.padStart(2, '0')}`
        } else {
          // Assume MM/DD/YYYY format (common in US)
          return `${part3}-${part1.padStart(2, '0')}-${part2.padStart(2, '0')}`
        }
      }
    }
    
    return dateStr // Return original if no pattern matches
  }

  // Extract data from OCR text using pattern matching
  const extractDataFromOCR = (text) => {
    console.log('Attempting OCR pattern extraction...')
    const data = {}

    // Clean text for better pattern matching
    const cleanText = text.replace(/\s+/g, ' ').trim()
    
    // Enhanced patterns for various ID formats
    const patterns = {
      // Document number patterns
      documentNumber: [
        /(?:ID|Doc|Document|Number|No|Card\s*No|Passport|License|#)[:\s]*([A-Z0-9\-]{4,25})/i,
        /(?:^|\n)([A-Z]{1,2}\d{6,12})\s/i, // Pattern like ID123456789
        /\b([A-Z]\d{8,10})\b/i, // Pattern like A123456789
      ],
      
      // Name patterns - more flexible
      firstName: [
        /(?:First\s*Name|Given\s*Name|Prenom)[:\s]*([A-Z][A-Za-z\s]{1,25}?)(?:\s|$|\n|Last|Surname)/i,
        /(?:^|\n)\s*([A-Z][A-Za-z]{2,20})\s+[A-Z][A-Za-z]{2,20}\s*(?:\n|$)/i, // First Last pattern
        /Name[:\s]*([A-Z][A-Za-z]{2,20})\s+([A-Z][A-Za-z]{2,20})/i, // Full name pattern
      ],
      
      lastName: [
        /(?:Last\s*Name|Surname|Family\s*Name|Nom)[:\s]*([A-Z][A-Za-z\s]{1,25}?)(?:\s|$|\n|DOB|Date|Sex)/i,
        /(?:^|\n)\s*[A-Z][A-Za-z]{2,20}\s+([A-Z][A-Za-z]{2,20})\s*(?:\n|$)/i, // First Last pattern
      ],
      
      // Date patterns - very flexible
      dateOfBirth: [
        /(?:DOB|Date\s*of\s*Birth|Born|Birth\s*Date|Naissance)[:\s]*(\d{1,2}[/\-.\s]\d{1,2}[/\-.\s]\d{2,4})/i,
        /(?:^|\n)(\d{1,2}[/\-.\s]\d{1,2}[/\-.\s]\d{4})\s/i, // Standalone date
        /\b(\d{2}[/\-]\d{2}[/\-]\d{4})\b/i, // DD/MM/YYYY or MM/DD/YYYY
      ],
      
      // Nationality patterns
      nationality: [
        /(?:Nationality|Citizen|Country|Nationalite)[:\s]*([A-Z][A-Za-z\s]{2,30})/i,
        /(?:^|\n)([A-Z]{3})\s*(?:$|\n)/i, // 3-letter country codes
      ],
      
      // Expiration date patterns
      expirationDate: [
        /(?:Exp|Expiry|Expires|Valid\s*Until|Expiration|Validite)[:\s]*(\d{1,2}[/\-.\s]\d{1,2}[/\-.\s]\d{2,4})/i,
        /(?:Valid\s*to|Until)[:\s]*(\d{1,2}[/\-.\s]\d{1,2}[/\-.\s]\d{2,4})/i,
      ],
      
      // Sex/Gender patterns
      sex: [
        /(?:Sex|Gender|Sexe)[:\s]*([MFmfHF])/i,
        /\b([MF])\s*(?:$|\n)/i, // Standalone M or F
      ],
    }

    // Try each pattern group
    for (const [key, patternArray] of Object.entries(patterns)) {
      for (const pattern of patternArray) {
        const match = cleanText.match(pattern)
        if (match && match[1]) {
          let value = match[1].trim()
          
          // Special handling for names from full name pattern
          if (key === 'firstName' && match[2]) {
            data.firstName = value
            data.lastName = match[2].trim()
            console.log(`Found names from pattern: ${value} ${match[2]}`)
            break
          }
          
          // Convert date formats to YYYY-MM-DD
          if (key === 'dateOfBirth' || key === 'expirationDate') {
            value = convertDateFormat(value)
          }
          
          // Normalize sex value
          if (key === 'sex') {
            value = value.toUpperCase() === 'H' ? 'M' : value.toUpperCase() // Handle French 'H' for Homme
          }
          
          // Validate minimum length for names
          if ((key === 'firstName' || key === 'lastName') && value.length < 2) {
            continue
          }
          
          data[key] = value
          console.log(`Found ${key}:`, value)
          break // Found match, try next field
        }
      }
    }

    // Additional fallback: try to extract any recognizable patterns
    if (Object.keys(data).length < 2) {
      console.log('Trying fallback extraction patterns...')
      
      // Look for any sequence of capital letters (possible names)
      const nameMatches = cleanText.match(/\b[A-Z][A-Z]{3,20}\b/g)
      if (nameMatches && nameMatches.length >= 2) {
        data.firstName = nameMatches[0]
        data.lastName = nameMatches[1]
        console.log('Fallback: Found names from capital sequences:', nameMatches)
      }
      
      // Look for any date-like patterns
      const dateMatches = cleanText.match(/\b\d{1,2}[/\-]\d{1,2}[/\-]\d{4}\b/g)
      if (dateMatches && dateMatches.length > 0) {
        data.dateOfBirth = convertDateFormat(dateMatches[0])
        console.log('Fallback: Found date pattern:', dateMatches[0])
      }
      
      // Look for alphanumeric sequences (possible document numbers)
      const docMatches = cleanText.match(/\b[A-Z0-9]{6,15}\b/g)
      if (docMatches && docMatches.length > 0) {
        data.documentNumber = docMatches[0]
        console.log('Fallback: Found document number pattern:', docMatches[0])
      }
    }

    console.log('OCR Extracted Data:', data)
    return Object.keys(data).length >= 1 ? data : null // Lowered threshold to 1 field
  }

  // Use scanned data for registration
  const useScannedData = () => {
    if (scanResult) {
      console.log('🚀 Navigating to registration with data:', scanResult)
      navigate('/register', { state: { scannedData: scanResult } })
    }
  }

  const videoConstraints = {
    facingMode,
    width: { ideal: 2560 },
    height: { ideal: 1440 },
    aspectRatio: 16 / 9,
  }

  return (
    <Box sx={{ minHeight: '100vh', bgcolor: 'background.default' }}>
      {/* Header */}
      <AppBar position="static">
        <Toolbar>
          <IconButton edge="start" color="inherit" onClick={() => navigate(-1)}>
            <ArrowBack />
          </IconButton>
          <Typography variant="h6" sx={{ flexGrow: 1, ml: 2, fontWeight: 600 }}>
            Scan Document
          </Typography>
        </Toolbar>
      </AppBar>

      <Container maxWidth="md" sx={{ py: 3 }}>
        {/* Instructions */}
        <Alert severity="info" sx={{ mb: 3 }}>
          <Typography variant="body2">
            <strong>How to scan:</strong> Place the document flat on a surface with good lighting.
            Align the document within the frame and capture the photo.
          </Typography>
        </Alert>

        {/* Camera/Image Display */}
        <Paper
          elevation={3}
          sx={{
            position: 'relative',
            overflow: 'hidden',
            borderRadius: 2,
            mb: 3,
            bgcolor: '#000',
            minHeight: '500px',
          }}
        >
          {!capturedImage ? (
            <>
              <Webcam
                ref={webcamRef}
                audio={false}
                screenshotFormat="image/jpeg"
                screenshotQuality={1}
                videoConstraints={videoConstraints}
                style={{
                  width: '100%',
                  minHeight: '500px',
                  objectFit: 'cover',
                  display: 'block',
                }}
              />
              
              {/* Camera Overlay Guide */}
              <Box
                sx={{
                  position: 'absolute',
                  top: '50%',
                  left: '50%',
                  transform: 'translate(-50%, -50%)',
                  width: '85%',
                  height: '55%',
                  border: '3px dashed rgba(255, 107, 53, 0.9)',
                  borderRadius: 2,
                  pointerEvents: 'none',
                  boxShadow: '0 0 0 2000px rgba(0, 0, 0, 0.4)',
                }}
              />
              
              {/* Corner Guides */}
              <Box
                sx={{
                  position: 'absolute',
                  top: '50%',
                  left: '50%',
                  transform: 'translate(-50%, -50%)',
                  width: '85%',
                  height: '55%',
                  pointerEvents: 'none',
                  '&::before, &::after': {
                    content: '""',
                    position: 'absolute',
                    width: '30px',
                    height: '30px',
                    border: '4px solid #FF6B35',
                  },
                  '&::before': {
                    top: '-4px',
                    left: '-4px',
                    borderRight: 'none',
                    borderBottom: 'none',
                  },
                  '&::after': {
                    top: '-4px',
                    right: '-4px',
                    borderLeft: 'none',
                    borderBottom: 'none',
                  },
                }}
              />
              <Box
                sx={{
                  position: 'absolute',
                  top: '50%',
                  left: '50%',
                  transform: 'translate(-50%, -50%)',
                  width: '85%',
                  height: '55%',
                  pointerEvents: 'none',
                  '&::before, &::after': {
                    content: '""',
                    position: 'absolute',
                    width: '30px',
                    height: '30px',
                    border: '4px solid #FF6B35',
                  },
                  '&::before': {
                    bottom: '-4px',
                    left: '-4px',
                    borderRight: 'none',
                    borderTop: 'none',
                  },
                  '&::after': {
                    bottom: '-4px',
                    right: '-4px',
                    borderLeft: 'none',
                    borderTop: 'none',
                  },
                }}
              />
            </>
          ) : (
            <img
              src={capturedImage}
              alt="Captured document"
              style={{ width: '100%', minHeight: '500px', objectFit: 'contain', display: 'block', backgroundColor: '#000' }}
            />
          )}
        </Paper>

        {/* Controls */}
        {!capturedImage ? (
          <Stack direction="row" spacing={2} justifyContent="center">
            <Button
              variant="outlined"
              size="large"
              startIcon={<FlipCameraAndroid />}
              onClick={toggleCamera}
            >
              Flip
            </Button>
            <Button
              variant="contained"
              size="large"
              startIcon={<CameraAlt />}
              onClick={capturePhoto}
              sx={{ px: 4 }}
            >
              Capture
            </Button>
          </Stack>
        ) : (
          <Stack direction="row" spacing={2} justifyContent="center">
            <Button
              variant="outlined"
              size="large"
              startIcon={<RestartAlt />}
              onClick={retakePhoto}
              disabled={scanning}
            >
              Retake
            </Button>
            {!scanResult && (
              <Button
                variant="contained"
                size="large"
                startIcon={scanning ? <CircularProgress size={20} color="inherit" /> : <CheckCircle />}
                onClick={processImage}
                disabled={scanning}
                sx={{ px: 4 }}
              >
                {scanning ? `Scanning... ${Math.round(progress)}%` : 'Scan Document'}
              </Button>
            )}
          </Stack>
        )}

        {/* Scanning Progress */}
        {scanning && (
          <Alert severity="info" icon={<CircularProgress size={20} />} sx={{ mt: 3 }}>
            <Typography variant="body2">
              <strong>Scanning in progress...</strong> {Math.round(progress)}%
              <br />
              {progress < 75 ? 'Extracting text from document...' : 
               progress < 100 ? 'Analyzing extracted data...' : 
               'Processing complete!'}
            </Typography>
          </Alert>
        )}

        {/* Error Message */}
        {error && (
          <Alert severity="warning" sx={{ mt: 3 }}>
            <Typography variant="body2" component="div" sx={{ 
              whiteSpace: 'pre-line',
              lineHeight: 1.6,
              fontSize: '0.9rem'
            }}>
              {error}
            </Typography>
            <Box sx={{ mt: 2, display: 'flex', gap: 1, flexWrap: 'wrap' }}>
              <Button
                variant="outlined"
                size="small"
                onClick={retakePhoto}
                startIcon={<CameraAlt />}
                sx={{ 
                  flexGrow: 1, 
                  minWidth: 120,
                  borderColor: '#FF6B35',
                  color: '#FF6B35',
                  '&:hover': {
                    borderColor: '#FF6B35',
                    backgroundColor: 'rgba(255, 107, 53, 0.04)'
                  }
                }}
              >
                Try Again
              </Button>
              <Button
                variant="contained"
                size="small"
                onClick={() => navigate('/register')}
                startIcon={<Edit />}
                sx={{ 
                  flexGrow: 1,
                  minWidth: 120,
                  background: 'linear-gradient(135deg, #FF6B35 0%, #F7931E 100%)',
                  '&:hover': {
                    background: 'linear-gradient(135deg, #E55A2B 0%, #E8831A 100%)',
                  }
                }}
              >
                Manual Entry
              </Button>
            </Box>
          </Alert>
        )}

        {/* Scan Results */}
        {scanResult && (
          <Card sx={{ mt: 3 }}>
            <CardContent>
              <Stack direction="row" alignItems="center" justifyContent="space-between" mb={2}>
                <Typography variant="h6" fontWeight="600">
                  Scan Results
                </Typography>
                <Chip
                  label={scanResult.confidence + ' Confidence'}
                  color={scanResult.confidence === 'High' ? 'success' : 'warning'}
                  size="small"
                />
              </Stack>

              <Stack spacing={1.5}>
                {scanResult.documentType && (
                  <Box>
                    <Typography variant="caption" color="text.secondary">
                      Document Type
                    </Typography>
                    <Typography variant="body1" fontWeight="600">
                      {scanResult.documentType}
                    </Typography>
                  </Box>
                )}

                {scanResult.documentNumber && (
                  <Box>
                    <Typography variant="caption" color="text.secondary">
                      Document Number
                    </Typography>
                    <Typography variant="body1" fontWeight="600">
                      {scanResult.documentNumber}
                    </Typography>
                  </Box>
                )}

                {scanResult.firstName && (
                  <Box>
                    <Typography variant="caption" color="text.secondary">
                      First Name
                    </Typography>
                    <Typography variant="body1" fontWeight="600">
                      {scanResult.firstName}
                    </Typography>
                  </Box>
                )}

                {scanResult.lastName && (
                  <Box>
                    <Typography variant="caption" color="text.secondary">
                      Last Name
                    </Typography>
                    <Typography variant="body1" fontWeight="600">
                      {scanResult.lastName}
                    </Typography>
                  </Box>
                )}

                {scanResult.dateOfBirth && (
                  <Box>
                    <Typography variant="caption" color="text.secondary">
                      Date of Birth
                    </Typography>
                    <Typography variant="body1" fontWeight="600">
                      {scanResult.dateOfBirth}
                    </Typography>
                  </Box>
                )}

                {scanResult.nationality && (
                  <Box>
                    <Typography variant="caption" color="text.secondary">
                      Nationality
                    </Typography>
                    <Typography variant="body1" fontWeight="600">
                      {scanResult.nationality}
                    </Typography>
                  </Box>
                )}

                {scanResult.expirationDate && (
                  <Box>
                    <Typography variant="caption" color="text.secondary">
                      Expiration Date
                    </Typography>
                    <Typography variant="body1" fontWeight="600">
                      {scanResult.expirationDate}
                    </Typography>
                  </Box>
                )}
              </Stack>

              <Button
                fullWidth
                variant="contained"
                size="large"
                onClick={useScannedData}
                sx={{ mt: 3 }}
              >
                Use for Guest Registration
              </Button>

              <Button
                fullWidth
                variant="outlined"
                size="large"
                onClick={retakePhoto}
                sx={{ mt: 1.5 }}
              >
                Scan Another Document
              </Button>
            </CardContent>
          </Card>
        )}
      </Container>
    </Box>
  )
}
