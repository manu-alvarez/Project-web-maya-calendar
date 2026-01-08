import { test, expect } from '@playwright/test';

test.describe('Calendario Maya', () => {
  test('should display today kin on homepage', async ({ page }) => {
    await page.goto('/');

    await expect(page.locator('text=/Kin del día/i')).toBeVisible({ timeout: 10000 });
  });

  test('should navigate to kin search', async ({ page }) => {
    await page.goto('/');

    await page.click('text=/Buscar/i');

    await expect(page.locator('input[placeholder*="número de kin"]')).toBeVisible({ timeout: 5000 });
  });

  test('should search kin by number', async ({ page }) => {
    await page.goto('/search');

    await page.fill('input[placeholder*="número de kin"]', '1');

    await page.click('button:has-text("Buscar")');

    await expect(page.locator('text=/Dragón/i')).toBeVisible({ timeout: 5000 });
    await expect(page.locator('text=/Magnético/i')).toBeVisible({ timeout: 5000 });
  });

  test('should display oracle calculation', async ({ page }) => {
    await page.goto('/oracle');

    await page.fill('input[placeholder*="kin"]', '1');

    await page.click('button:has-text("Calcular")');

    await expect(page.locator('text=/Destino/i')).toBeVisible({ timeout: 5000 });
    await expect(page.locator('text=/Guía/i')).toBeVisible({ timeout: 5000 });
    await expect(page.locator('text=/Análogo/i')).toBeVisible({ timeout: 5000 });
    await expect(page.locator('text=/Antípoda/i')).toBeVisible({ timeout: 5000 });
    await expect(page.locator('text=/Oculto/i')).toBeVisible({ timeout: 5000 });
  });
});
