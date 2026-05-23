import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],

  theme: {
      extend: {
        colors: {
          // Base scales
          primary: {
            DEFAULT: '#004ac6',
            dark: '#1D4ED8',
            light: '#DBEAFE',
            container: '#2563eb',
            fixed: '#dbe1ff',
            'fixed-dim': '#b4c5ff',
            'on-fixed-variant': '#003ea8',
            'on-fixed': '#00174b',
          },
          neutral: {
            900: '#0F172A',
            700: '#334155',
            500: '#64748B',
            300: '#CBD5E1',
            100: '#F1F5F9',
          },
          success: {
            DEFAULT: '#16A34A',
            light: '#dcfce7',
          },
          warning: {
            DEFAULT: '#D97706',
            light: '#fef9c3',
          },
          danger: {
            DEFAULT: '#dc2626',
            dark: '#b91c1c',
            light: '#fee2e2',
          },
          info: {
            DEFAULT: '#0284C7',
            light: '#dbeafe',
          },
          // Semantic & Surface Colors (Stitch/Material)
          'on-tertiary-fixed-variant': '#7d2d00',
          'secondary-fixed-dim': '#bec6e0',
          'badge-pending-bg': '#FEF9C3',
          'on-background': '#191b23',
          error: {
            DEFAULT: '#ba1a1a',
            container: '#ffdad6',
            'on-container': '#93000a',
          },
          'surface-container-low': '#f3f3fe',
          'on-tertiary-container': '#ffede6',
          'tertiary-fixed-dim': '#ffb596',
          'badge-approved-bg': '#DCFCE7',
          'surface-container-lowest': '#ffffff',
          'outline-variant': '#c3c6d7',
          'surface-bright': '#faf8ff',
          'secondary-container': '#dae2fd',
          tertiary: {
            DEFAULT: '#943700',
            container: '#bc4800',
            fixed: '#ffdbcd',
            'fixed-dim': '#ffb596',
            'on-fixed': '#360f00',
          },
          'inverse-primary': '#b4c5ff',
          'inverse-surface': '#2e3039',
          'on-secondary': '#ffffff',
          'on-primary-container': '#eeefff',
          outline: '#737686',
          surface: {
            DEFAULT: '#faf8ff',
            tint: '#0053db',
            variant: '#e1e2ed',
            dim: '#d9d9e5',
            bright: '#faf8ff',
          },
          'on-surface-variant': '#434655',
          'on-secondary-fixed': '#131b2e',
          'surface-container-highest': '#e1e2ed',
          'surface-container-high': '#e7e7f3',
          'on-primary': '#ffffff',
          'on-secondary-fixed-variant': '#3f465c',
          'on-tertiary': '#ffffff',
          'on-secondary-container': '#5c647a',
          'secondary-fixed': '#dae2fd',
          background: '#faf8ff',
          'on-error': '#ffffff',
          'inverse-on-surface': '#f0f0fb',
          secondary: {
            DEFAULT: '#565e74',
            container: '#dae2fd',
            fixed: '#dae2fd',
            'fixed-dim': '#bec6e0',
          },
          'surface-container': '#ededf9',
          'on-surface': '#191b23',
          'badge-rejected-bg': '#FEE2E2',
        },
        borderRadius: {
          'DEFAULT': '0.25rem',
          'sm': '4px',
          'md': '8px',
          'lg': '12px',
          'xl': '16px',
          'full': '9999px',
        },
        spacing: {
          'xl': '32px',
          '2xl': '48px',
          'sidebar-width': '240px',
          'header-height': '64px',
          '3xl': '64px',
          'xs': '4px',
          'sm': '8px',
          'md': '16px',
          'lg': '24px'
        },
        fontFamily: {
          'button-text': ['Inter'],
          'sub-heading': ['Inter'],
          'body-text': ['Inter'],
          'small-text': ['Inter'],
          'page-title': ['Inter'],
          'label-text': ['Inter'],
          'section-heading': ['Inter']
        },
        fontSize: {
          'button-text': ['14px', {
            'lineHeight': '20px',
            'fontWeight': '500'
          }],
          'sub-heading': ['16px', {
            'lineHeight': '24px',
            'fontWeight': '600'
          }],
          'body-text': ['14px', {
            'lineHeight': '20px',
            'fontWeight': '400'
          }],
          'small-text': ['12px', {
            'lineHeight': '16px',
            'fontWeight': '400'
          }],
          'page-title': ['24px', {
            'lineHeight': '32px',
            'letterSpacing': '-0.02em',
            'fontWeight': '700'
          }],
          'label-text': ['14px', {
            'lineHeight': '20px',
            'fontWeight': '500'
          }],
          'section-heading': ['20px', {
            'lineHeight': '28px',
            'fontWeight': '600'
          }]
        }
      }
  },

  plugins: [forms],
};
