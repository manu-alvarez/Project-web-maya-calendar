# Design System

## Overview

This document defines the UI Kit and design specifications for the Maya Calendar web application, based on Material Design 3 (Material UI M3).

## Design Principles

- Professional and accessible interface
- Consistent visual language across all components
- Scalable component library
- Mobile-first responsive design
- Material Design 3 guidelines

## Spacing and Layout

### Grid System
- **Grid Base**: 8px
- **Max Content Width**: 1440px
- **Container Gutter**: 16px (mobile), 24px (tablet/desktop)

### Spacing Scale
| Scale | Value | Usage |
|-------|-------|-------|
| 1x | 8px | Small spacing, icon padding |
| 2x | 16px | Default padding, mobile gutter |
| 3x | 24px | Medium spacing, tablet/desktop gutter |
| 4x | 32px | Large spacing, section separation |
| 6x | 48px | Extra large spacing, major sections |
| 8x | 64px | Page margins, hero sections |

## Color Palette

### Primary Colors (Material M3)
```javascript
const colors = {
  primary: '#6750A4',
  onPrimary: '#FFFFFF',
  primaryContainer: '#EADDFF',
  onPrimaryContainer: '#21005D',
  
  secondary: '#625B71',
  onSecondary: '#FFFFFF',
  secondaryContainer: '#E8DEF8',
  onSecondaryContainer: '#1D192B',
  
  tertiary: '#7D5260',
  onTertiary: '#FFFFFF',
  tertiaryContainer: '#FFD8E4',
  onTertiaryContainer: '#31111D',
  
  error: '#B3261E',
  onError: '#FFFFFF',
  errorContainer: '#F9DEDC',
  onErrorContainer: '#410E0B',
  
  background: '#FFFBFE',
  onBackground: '#1C1B1F',
  
  surface: '#FFFBFE',
  onSurface: '#1C1B1F',
  surfaceVariant: '#E7E0EC',
  onSurfaceVariant: '#49454F',
  
  outline: '#79747E',
  outlineVariant: '#CAC4D0',
  
  inverseSurface: '#313033',
  inverseOnSurface: '#F4EFF4',
  inversePrimary: '#D0BCFF',
  
  shadow: '#000000',
  scrim: '#000000',
}
```

### Maya-Themed Colors (Accent)
```javascript
const mayaColors = {
  gold: '#D4AF37',
  jade: '#00A86B',
  obsidian: '#1A1A1A',
  turquoise: '#40E0D0',
  terracotta: '#E2725B',
}
```

## Typography

### Font Families
- **Primary**: Roboto (system default fallback)
- **Headings**: Roboto Slab or similar serif
- **Monospace**: Roboto Mono

### Type Scale (Material M3)
```javascript
const typography = {
  displayLarge: {
    fontSize: '57px',
    lineHeight: '64px',
    fontWeight: 400,
  },
  displayMedium: {
    fontSize: '45px',
    lineHeight: '52px',
    fontWeight: 400,
  },
  displaySmall: {
    fontSize: '36px',
    lineHeight: '44px',
    fontWeight: 400,
  },
  headlineLarge: {
    fontSize: '32px',
    lineHeight: '40px',
    fontWeight: 400,
  },
  headlineMedium: {
    fontSize: '28px',
    lineHeight: '36px',
    fontWeight: 400,
  },
  headlineSmall: {
    fontSize: '24px',
    lineHeight: '32px',
    fontWeight: 400,
  },
  titleLarge: {
    fontSize: '22px',
    lineHeight: '28px',
    fontWeight: 400,
  },
  titleMedium: {
    fontSize: '16px',
    lineHeight: '24px',
    fontWeight: 500,
  },
  titleSmall: {
    fontSize: '14px',
    lineHeight: '20px',
    fontWeight: 500,
  },
  bodyLarge: {
    fontSize: '16px',
    lineHeight: '24px',
    fontWeight: 400,
  },
  bodyMedium: {
    fontSize: 14px,
    lineHeight: '20px',
    fontWeight: 400,
  },
  bodySmall: {
    fontSize: 12px,
    lineHeight: '16px',
    fontWeight: 400,
  },
  labelLarge: {
    fontSize: 14px,
    lineHeight: '20px',
    fontWeight: 500,
  },
  labelMedium: {
    fontSize: 12px,
    lineHeight: '16px',
    fontWeight: 500,
  },
  labelSmall: {
    fontSize: 11px,
    lineHeight: '16px',
    fontWeight: 500,
  },
}
```

## Component Library

### Base Components

#### AppBar
- Fixed at top
- Contains: Logo, Navigation, Login/Logout
- Height: 64px (desktop), 56px (mobile)
- Background: Surface color
- Shadow: Elevation 4

#### CardKin
- Displays Kin information
- Variants: Compact, Detailed
- Contains: Kin number, seal, tone, color, relationships
- Actions: View detail, save as favorite

#### CardOnda
- Displays Encanted Wave summary
- Grid layout for 13 Kins
- Expandable details for each Kin
- Date selector at top

#### DatePicker
- Material UI M3 DatePicker component
- Supports: Single date selection, date range
- Localization: Spanish
- Format: DD/MM/YYYY

#### Button
- Variants: Filled, Outlined, Text, Elevated, Tonal
- Sizes: Small, Medium, Large
- States: Default, Hover, Focus, Disabled, Loading

#### TextField
- Material UI M3 TextField
- Variants: Outlined, Filled
- Validation: Real-time, on blur
- Helper text and error messages

#### ModalKinDetalle
- Full-screen modal for detailed Kin information
- Scrollable content
- Close button
- Print-friendly layout

#### FormLogin
- Email/Password fields
- "Remember me" checkbox
- Forgot password link
- Google OAuth button
- Form validation

#### FormRegistro
- Email field
- Password and confirm password fields
- Name field
- Terms and conditions checkbox
- OTP verification step

#### Snackbar
- Toast notifications
- Variants: Success, Error, Warning, Info
- Auto-dismiss after 4 seconds
- Action button optional

#### LoadingSpinner
- Circular progress indicator
- Full-screen overlay for global loading
- Inline indicator for component loading

## Layout Components

### Container
- Max-width: 1440px
- Centered with auto margins
- Padding: 16px (mobile), 24px (tablet/desktop)

### Grid
- 12-column grid system
- Responsive breakpoints
- Gutter: 16px (mobile), 24px (tablet/desktop)

### Responsive Breakpoints
```javascript
const breakpoints = {
  xs: '0px',
  sm: '600px',
  md: '900px',
  lg: '1200px',
  xl: '1536px',
}
```

## Icon System

- Material Icons (default)
- Custom Maya-themed icons (to be designed)
- SVG format
- Sizes: 16px, 20px, 24px, 32px, 48px

## Elevation and Shadows

```javascript
const elevation = {
  0: { boxShadow: 'none' },
  1: { boxShadow: '0px 1px 2px rgba(0,0,0,0.3)' },
  2: { boxShadow: '0px 1px 2px rgba(0,0,0,0.3), 0px 2px 6px 2px rgba(0,0,0,0.15)' },
  3: { boxShadow: '0px 4px 8px 3px rgba(0,0,0,0.15)' },
  4: { boxShadow: '0px 6px 10px 4px rgba(0,0,0,0.15)' },
  5: { boxShadow: '0px 8px 12px 6px rgba(0,0,0,0.15)' },
}
```

## Animation and Motion

### Duration
- Fast: 150ms
- Medium: 300ms
- Slow: 500ms

### Easing
- Standard: cubic-bezier(0.4, 0.0, 0.2, 1)
- Decelerated: cubic-bezier(0.0, 0.0, 0.2, 1)
- Accelerated: cubic-bezier(0.4, 0.0, 1, 1)

## Accessibility

### Color Contrast
- WCAG AA compliant (minimum 4.5:1 for normal text)
- WCAG AAA compliant for large text (7:1)

### Keyboard Navigation
- All interactive elements keyboard accessible
- Focus states clearly visible
- Tab order logical

### Screen Reader Support
- ARIA labels where needed
- Semantic HTML elements
- Alt text for images

## Responsive Behavior

### Mobile (< 600px)
- Single column layout
- Hamburger menu for navigation
- Bottom sheet for modals
- Touch-optimized spacing (minimum 44px tap targets)

### Tablet (600px - 900px)
- Two column layout where appropriate
- Side navigation or top navigation
- Larger touch targets

### Desktop (> 900px)
- Multi-column layout
- Full navigation menu
- Hover states enabled

## Documentation Structure

Create the following documentation files in `/docs/design-system/`:

1. **colors.md** - Detailed color palette with usage examples
2. **typography.md** - Type scale with code examples
3. **components.md** - Component catalog with props and examples
4. **layout.md** - Layout system and responsive patterns
5. **accessibility.md** - Accessibility guidelines and checklist
6. **assets.md** - Image and icon specifications

## Implementation Notes

### Theme Configuration
```javascript
// theme.js
import { createTheme } from '@mui/material/styles'

const theme = createTheme({
  palette: {
    // Color palette defined above
  },
  typography: {
    // Typography scale defined above
  },
  components: {
    // Component overrides
  },
  breakpoints: {
    // Breakpoints defined above
  },
})

export default theme
```

### Global Styles
```css
/* global.css */
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
  font-family: 'Roboto', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
```

## Future Enhancements

- Dark mode support
- Custom theme presets
- Storybook integration
- Component testing library
- Design tokens export (JSON, CSS variables)
