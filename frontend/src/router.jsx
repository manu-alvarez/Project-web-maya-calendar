import { createBrowserRouter, RouterProvider, Navigate } from 'react-router-dom';
import AppLayout from './components/common/AppLayout';
import LoginPage from './pages/auth/LoginPage';
import RegisterPage from './pages/auth/RegisterPage';
import ForgotPasswordPage from './pages/auth/ForgotPasswordPage';

const router = createBrowserRouter([
  {
    path: '/',
    element: <AppLayout />,
    children: [
        {
            index: true,
            element: <div>Home Page - Coming Soon</div>,
        },
        {
            path: 'kin/:kinId',
            element: <div>Kin Detail Page - Coming Soon</div>,
        },
        {
            path: 'onda/:ondaId',
            element: <div>Onda Detail Page - Coming Soon</div>,
        },
        {
            path: 'user/profile',
            element: <div>User Profile - Coming Soon</div>,
        },
        {
            path: 'user/dashboard',
            element: <div>User Dashboard - Coming Soon</div>,
        },
        {
            path: 'auth/login',
            element: <LoginPage />,
        },
        {
            path: 'auth/register',
            element: <RegisterPage />,
        },
        {
            path: 'auth/forgot-password',
            element: <ForgotPasswordPage />,
        },
    ],
  },
]);

export default router;
