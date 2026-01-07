import React from 'react';
import { Box, Container, Typography, Link } from '@mui/material';

function Footer() {
  return (
    <Box
      component="footer"
      sx={{
        py: 3,
        px: 2,
        mt: 'auto',
        backgroundColor: (theme) =>
          theme.palette.mode === 'light'
            ? theme.palette.grey[200]
            : theme.palette.grey[800],
      }}
    >
      <Container maxWidth="lg">
        <Typography variant="body2" color="text.secondary" align="center">
          © {new Date().getFullYear()} Maya Calendar. Basado en el Calendario Sincronizador Maya
          (Dreamspell).
        </Typography>
        <Typography variant="body2" color="text.secondary" align="center" sx={{ mt: 1 }}>
          <Link href="/about" color="inherit" underline="hover">
            Sobre el Proyecto
          </Link>
          {' • '}
          <Link href="/privacy" color="inherit" underline="hover">
            Privacidad
          </Link>
          {' • '}
          <Link href="/terms" color="inherit" underline="hover">
            Términos
          </Link>
        </Typography>
      </Container>
    </Box>
  );
}

export default Footer;
