import React from 'react';
import { Outlet } from 'react-router-dom';
import { Box } from '@mui/material';
import NavigationBar from './NavigationBar';
import Footer from './Footer';

function AppLayout() {
  return (
    <Box
      sx={{
        display: 'flex',
        flexDirection: 'column',
        minHeight: '100vh',
      }}
    >
      <NavigationBar />
      <Box
        component="main"
        sx={{
          flexGrow: 1,
          display: 'flex',
          flexDirection: 'column',
        }}
      >
        <Outlet />
      </Box>
      <Footer />
    </Box>
  );
}

export default AppLayout;
