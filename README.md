# AspenDigital.Translate
Customizations to the RainLab.Translate plugin.

## HomeLocalePicker Component
This plugin registers a component named `homeLocalePicker` that can be used in place of RainLab.Translate's `localePicker` component. The only difference is that `homeLocalePicker` will redirect to the home page on locale change rather than redirecting to the current page in the new locale.

## Static Pages Master Locale Switcher
When editing static pages, you will see a `Change Locale` button in the form toolbar. This can be used to change the locale of all translatable fields in the page form.

## Static Page Locale Routing
RainLab.Translate falls back to the default locale URL if unassigned in the active locale. This plugin overrides that behavior to return a 404 if a static page does not have a locale URL defined.