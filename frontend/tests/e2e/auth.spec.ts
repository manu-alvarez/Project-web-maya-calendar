import { test, expect } from '@playwright/test';

test.describe('Autenticación', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('/auth/register');
  });

  test('should display registration page', async ({ page }) => {
    await expect(page).toHaveTitle(/Registro/);
    await expect(page.locator('input[name="name"]')).toBeVisible();
    await expect(page.locator('input[name="email"]')).toBeVisible();
    await expect(page.locator('input[name="password"]')).toBeVisible();
    await expect(page.locator('input[name="password_confirmation"]')).toBeVisible();
  });

  test('should show validation errors for empty fields', async ({ page }) => {
    await page.click('button[type="submit"]');

    await expect(page.locator('text=/El nombre es requerido/i')).toBeVisible({ timeout: 5000 });
    await expect(page.locator('text=/El email es requerido/i')).toBeVisible({ timeout: 5000 });
    await expect(page.locator('text=/La contraseña es requerida/i')).toBeVisible({ timeout: 5000 });
  });

  test('should show validation error for invalid email', async ({ page }) => {
    await page.fill('input[name="name"]', 'Test User');
    await page.fill('input[name="email"]', 'invalid-email');
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'password123');

    await page.click('button[type="submit"]');

    await expect(page.locator('text=/email.*válido/i')).toBeVisible({ timeout: 5000 });
  });

  test('should show validation error for short password', async ({ page }) => {
    await page.fill('input[name="name"]', 'Test User');
    await page.fill('input[name="email"]', 'test@example.com');
    await page.fill('input[name="password"]', 'short');
    await page.fill('input[name="password_confirmation"]', 'short');

    await page.click('button[type="submit"]');

    await expect(page.locator('text=/contraseña.*al menos.*caracteres/i')).toBeVisible({ timeout: 5000 });
  });

  test('should show validation error for mismatched passwords', async ({ page }) => {
    await page.fill('input[name="name"]', 'Test User');
    await page.fill('input[name="email"]', 'test@example.com');
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'different123');

    await page.click('button[type="submit"]');

    await expect(page.locator('text=/contraseñas.*coinciden/i')).toBeVisible({ timeout: 5000 });
  });

  test('should successfully register user and redirect to login', async ({ page }) => {
    const timestamp = Date.now();
    const email = `testuser${timestamp}@example.com`;

    await page.fill('input[name="name"]', 'Test User');
    await page.fill('input[name="email"]', email);
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'password123');

    await page.click('button[type="submit"]');

    await expect(page).toHaveURL(/\/auth\/login/, { timeout: 10000 });
    await expect(page.locator('text=/Registro exitoso/i')).toBeVisible({ timeout: 5000 });
  });

  test('should navigate to login page from register', async ({ page }) => {
    await page.click('text=/¿Ya tienes cuenta\?/i');

    await expect(page).toHaveURL(/\/auth\/login/, { timeout: 5000 });
    await expect(page.locator('input[name="email"]')).toBeVisible();
    await expect(page.locator('input[name="password"]')).toBeVisible();
  });

  test('should login with valid credentials', async ({ page }) => {
    await page.goto('/auth/login');
    await page.fill('input[name="email"]', 'test@example.com');
    await page.fill('input[name="password"]', 'password123');

    await page.click('button[type="submit"]');

    await expect(page).toHaveURL(/\/user\/dashboard/, { timeout: 10000 });
  });

  test('should show error for invalid credentials', async ({ page }) => {
    await page.goto('/auth/login');
    await page.fill('input[name="email"]', 'nonexistent@example.com');
    await page.fill('input[name="password"]', 'wrongpassword');

    await page.click('button[type="submit"]');

    await expect(page.locator('text=/Credenciales.*inválidas/i')).toBeVisible({ timeout: 5000 });
  });

  test('should logout user', async ({ page }) => {
    await page.goto('/auth/login');
    await page.fill('input[name="email"]', 'test@example.com');
    await page.fill('input[name="password"]', 'password123');

    await page.click('button[type="submit"]');

    await expect(page).toHaveURL(/\/user\/dashboard/, { timeout: 10000 });

    await page.goto('/auth/logout');

    await expect(page).toHaveURL(/\/auth\/login/, { timeout: 5000 });
  });
});
