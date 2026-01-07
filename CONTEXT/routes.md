# Routes

## Frontend Routes (React Router)

All routes are managed by React Router with protection logic based on user authentication status.

### Public Routes (All Users)

| Route | Component | Description | Protected |
|-------|-----------|-------------|-----------|
| `/` | Home | Landing page showing today's Kin | No |
| `/kin/:date` | KinDetail | Detailed view of a specific Kin by date | No |
| `/onda/:date` | OndaDetail | Encanted Wave for a specific date | No |
| `/registro` | Register | User registration form | No |
| `/login` | Login | User login form | No |
| `/forgot-password` | ForgotPassword | Password recovery request | No |
| `/reset-password/:token` | ResetPassword | Password reset with token | No |
| `/sobre` | About | Information about the Maya calendar and project purpose | No |
| `/ayuda` | Help | FAQ and basic guide | No |
| `/legal/terminos` | Terms | Terms of service | No |
| `/legal/privacidad` | Privacy | Privacy policy | No |

### Protected Routes (Registered Users Only)

| Route | Component | Description | Protected |
|-------|-----------|-------------|-----------|
| `/perfil` | Profile | User profile and settings | Yes |
| `/perfil/editar` | EditProfile | Edit user profile information | Yes |
| `/favoritos` | Favorites | List of saved/favorited dates | Yes |
| `/recordatorios` | Reminders | Manage reminders for specific dates | Yes |
| `/recordatorios/crear` | CreateReminder | Create a new reminder | Yes |
| `/recordatorios/:id/editar` | EditReminder | Edit existing reminder | Yes |

### Extended Content Routes (Registered Users)

These routes use the same path components as public routes but provide additional features:

| Route | Component | Additional Features |
|-------|-----------|-------------------|
| `/kin/:date` | KinDetail | Save to favorites, add reminder, extended interpretation |
| `/onda/:date` | OndaDetail | Save to favorites, add reminder, extended information |

### Admin Routes (Future Phases)

| Route | Component | Description | Protected |
|-------|-----------|-------------|-----------|
| `/admin` | AdminDashboard | Admin dashboard | Yes (Admin role) |
| `/admin/contenido` | ContentManagement | Manage Kin and Onda content | Yes (Admin role) |
| `/admin/usuarios` | UserManagement | Manage users | Yes (Admin role) |
| `/admin/estadisticas` | Analytics | View site statistics | Yes (Admin role) |

## Route Protection Logic

### AuthGuard Component

```jsx
const AuthGuard = ({ children }) => {
  const { isAuthenticated } = useAuth()
  
  if (!isAuthenticated) {
    return <Navigate to="/login" replace />
  }
  
  return children
}

// Usage in Routes
<Route path="/perfil" element={<AuthGuard><Profile /></AuthGuard>} />
```

### AdminGuard Component

```jsx
const AdminGuard = ({ children }) => {
  const { isAuthenticated, user } = useAuth()
  
  if (!isAuthenticated) {
    return <Navigate to="/login" replace />
  }
  
  if (!user.isAdmin) {
    return <Navigate to="/" replace />
  }
  
  return children
}
```

## Route Parameters

### Kin Detail Route
```jsx
// Route definition
<Route path="/kin/:date" element={<KinDetail />} />

// Parameter format: YYYY-MM-DD
// Example: /kin/2024-01-15

// Access in component
const { date } = useParams()
// date = "2024-01-15"
```

### Onda Detail Route
```jsx
// Route definition
<Route path="/onda/:date" element={<OndaDetail />} />

// Parameter format: YYYY-MM-DD
// Example: /onda/2024-01-15

// Access in component
const { date } = useParams()
```

### Reminder Edit Route
```jsx
// Route definition
<Route path="/recordatorios/:id/editar" element={<EditReminder />} />

// Parameter format: reminder ID
// Example: /recordatorios/123/editar

// Access in component
const { id } = useParams()
```

## Query Parameters

### Kin Detail with Date Navigation
```
/kin/2024-01-15?navigation=today
```

### Onda Detail with View Mode
```
/onda/2024-01-15?view=grid
```

### Favorites with Filter
```
/favoritos?month=2024-01&sort=date
```

### Reminders with Filter
```
/recordatorios?status=upcoming&sort=date
```

## Navigation Patterns

### Main Navigation (AppBar)

For anonymous users:
- Home (`/`)
- About (`/sobre`)
- Help (`/ayuda`)
- Login (`/login`)
- Register (`/registro`)

For authenticated users:
- Home (`/`)
- Profile (`/perfil`)
- Favorites (`/favoritos`)
- Reminders (`/recordatorios`)
- About (`/sobre`)
- Help (`/ayuda`)
- Logout

### Bottom Navigation (Mobile)

For authenticated users:
- Home (today's Kin)
- Favorites
- Reminders
- Profile

## Route Configuration File

```jsx
// routes.js
import { Navigate } from 'react-router-dom'
import { Home, KinDetail, OndaDetail } from './pages'
import { Register, Login, ForgotPassword, ResetPassword } from './pages/auth'
import { Profile, Favorites, Reminders, CreateReminder, EditReminder } from './pages/user'
import { About, Help } from './pages/info'
import { Terms, Privacy } from './pages/legal'
import { AuthGuard, AdminGuard } from './components/guards'

export const publicRoutes = [
  { path: '/', element: <Home /> },
  { path: '/kin/:date', element: <KinDetail /> },
  { path: '/onda/:date', element: <OndaDetail /> },
  { path: '/registro', element: <Register /> },
  { path: '/login', element: <Login /> },
  { path: '/forgot-password', element: <ForgotPassword /> },
  { path: '/reset-password/:token', element: <ResetPassword /> },
  { path: '/sobre', element: <About /> },
  { path: '/ayuda', element: <Help /> },
  { path: '/legal/terminos', element: <Terms /> },
  { path: '/legal/privacidad', element: <Privacy /> },
]

export const protectedRoutes = [
  { 
    path: '/perfil', 
    element: <AuthGuard><Profile /></AuthGuard> 
  },
  { 
    path: '/perfil/editar', 
    element: <AuthGuard><EditProfile /></AuthGuard> 
  },
  { 
    path: '/favoritos', 
    element: <AuthGuard><Favorites /></AuthGuard> 
  },
  { 
    path: '/recordatorios', 
    element: <AuthGuard><Reminders /></AuthGuard> 
  },
  { 
    path: '/recordatorios/crear', 
    element: <AuthGuard><CreateReminder /></AuthGuard> 
  },
  { 
    path: '/recordatorios/:id/editar', 
    element: <AuthGuard><EditReminder /></AuthGuard> 
  },
]

export const adminRoutes = [
  { 
    path: '/admin', 
    element: <AdminGuard><AdminDashboard /></AuthGuard> 
  },
  { 
    path: '/admin/contenido', 
    element: <AdminGuard><ContentManagement /></AuthGuard> 
  },
  { 
    path: '/admin/usuarios', 
    element: <AdminGuard><UserManagement /></AuthGuard> 
  },
  { 
    path: '/admin/estadisticas', 
    element: <AdminGuard><Analytics /></AuthGuard> 
  },
]

export const notFoundRoute = {
  path: '*',
  element: <Navigate to="/" replace />
}
```

## Redirect Logic

### After Login
- If user was trying to access a protected route: Redirect to that route
- Otherwise: Redirect to `/`

### After Registration
- Redirect to `/` with welcome message

### After Logout
- Redirect to `/`

### After Password Reset
- Redirect to `/login` with success message

## Error Handling Routes

### 404 Not Found
```jsx
<Route path="*" element={<NotFound />} />
```

### 500 Server Error
```jsx
<Route path="/error/500" element={<ServerError />} />
```

## Lazy Loading (Code Splitting)

```jsx
const Home = lazy(() => import('./pages/Home'))
const KinDetail = lazy(() => import('./pages/KinDetail'))
const OndaDetail = lazy(() => import('./pages/OndaDetail'))

// Wrap with Suspense
<Suspense fallback={<LoadingSpinner />}>
  <Routes>
    <Route path="/" element={<Home />} />
  </Routes>
</Suspense>
```

## SEO Considerations

### Meta Tags per Route
- Title: Dynamic based on route
- Description: Dynamic based on content
- Open Graph tags for sharing
- Canonical URLs

### Example: Kin Detail Page
```jsx
useEffect(() => {
  document.title = `Kin ${kinNumber} - ${kinDate} | Maya Calendar`
  document.querySelector('meta[name="description"]').setAttribute(
    'content', 
    `Discover the Kin ${kinNumber} for ${kinDate}. ${kinDescription}`
  )
}, [kinNumber, kinDate, kinDescription])
```
