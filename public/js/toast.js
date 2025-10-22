// Disable HTML escaping
toastr.options.escapeHtml = false;

// Custom formatter
function customToastContent(message, type = 'success') {
  const titleMap = {
    success: '✅ Success!',
    error: '❌ Error!',
    info: 'ℹ️ Info',
    warning: '⚠️ Warning',
  };

  return `
    <div class='electric-arc'></div>
    <div class='floating-text'>
      <span>${titleMap[type] || ''}</span>
      <strong>${message}</strong>
    </div>
    <div class='dollar-float'>$</div>
    <div class='dollar-float delay-1'>$</div>
    <div class='dollar-float delay-2'>$</div>
  `;
}

// Override ALL toastr types
['success', 'error', 'info', 'warning'].forEach(type => {
  const original = toastr[type];
  toastr[type] = function (message, title, optionsOverride) {
    const formatted = customToastContent(message, type);
    return original.call(this, formatted, null, optionsOverride);
  };
});
