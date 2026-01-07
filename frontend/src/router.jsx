import { createBrowserRouter, RouterProvider, Navigate } from 'react-router-dom';
import AppLayout from './components/common/AppLayout';

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
            element: <div>Login Page - Coming Soon</div>,
        },
        {
            path: 'auth/register',
            element: <div>Register Page - Coming Soon</div>,
        },
        {
            path: 'auth/forgot-password',
            element: <div>Forgot Password - Coming Soon</div>,
        },
    ],
  },
]);

export default router;
