# Design

## Design Philosophy

The design embodies the fusion of ancient wisdom and modern technology, creating a professional, accessible, and culturally respectful platform.

## Design Principles

1. **Professional Excellence**: High-quality visual design that conveys credibility
2. **Cultural Respect**: Design elements that honor Maya culture without appropriation
3. **Accessibility**: WCAG AA compliant, usable by all
4. **Didactic Clarity**: Information hierarchy that guides understanding
5. **Responsive Perfection**: Seamless experience across all devices

## Visual Identity

### Color Palette

#### Primary Colors (Material M3)
- Primary: #6750A4
- Secondary: #625B71
- Background: #FFFBFE
- Surface: #FFFFFF
- Text: #1C1B1F

#### Maya-Themed Accent Colors
- Gold: #D4AF37
- Jade: #00A86B
- Obsidian: #1A1A1A
- Turquoise: #40E0D0
- Terracotta: #E2725B

### Typography

#### Font Families
- Primary: Roboto (system default fallback)
- Headings: Roboto Slab or similar serif
- Monospace: Roboto Mono

#### Type Scale
- Display Large: 57px / 64px
- Display Medium: 45px / 52px
- Display Small: 36px / 44px
- Headline Large: 32px / 40px
- Headline Medium: 28px / 36px
- Headline Small: 24px / 32px
- Title Large: 22px / 28px
- Title Medium: 16px / 24px
- Title Small: 14px / 20px
- Body Large: 16px / 24px
- Body Medium: 14px / 20px
- Body Small: 12px / 16px

## Layout System

### Grid
- 12-column grid
- 8px base unit
- Gutter: 16px (mobile), 24px (tablet/desktop)
- Max content width: 1440px

### Spacing Scale
- 1x: 8px (small spacing, icon padding)
- 2x: 16px (default padding, mobile gutter)
- 3x: 24px (medium spacing, tablet/desktop gutter)
- 4x: 32px (large spacing, section separation)
- 6x: 48px (extra large spacing, major sections)
- 8x: 64px (page margins, hero sections)

## Components

### Core Components

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

## Animation & Motion

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

## Illustration Guidelines

### Style
- Professional and respectful
- Culturally appropriate
- Consistent with design system
- Optimized for web (SVG or optimized raster)

### Content
- Kin symbols and representations
- Maya calendar elements
- Conceptual illustrations
- Decorative elements that enhance understanding

## Page Layouts

### Home Page
- Hero section with today's Kin
- Quick date picker
- Navigation to Encanted Wave
- Call to action for registration (subtle)

### Kin Detail Page
- Kin information header
- Main characteristics display
- Extended interpretation section
- Relationships section (guide, analog, antipode, occult)
- Personal application section
- Save/Reminder actions (registered users)

### Encanted Wave Page
- Wave overview header
- 13-Kin grid display
- Each Kin with brief info
- Expandable details for each Kin
- Context and interpretation section
- Save/Reminder actions (registered users)

### Profile Page
- User information display
- Profile edit form
- Account settings
- Saved dates section
- Reminders section

### Registration/Login Pages
- Clean, focused layout
- Clear instructions
- Error handling
- Social login option

## Design System Documentation

Complete design system documentation located at:
- [design-system.md](../CONTEXT/design-system.md)

## Assets Management

### Image Optimization
- Responsive images with srcset
- Lazy loading for below-fold images
- WebP format with fallbacks
- Compression and sizing optimization

### Icon System
- Material Icons (default)
- Custom Maya-themed icons (to be designed)
- SVG format for scalability
- Sizes: 16px, 20px, 24px, 32px, 48px
