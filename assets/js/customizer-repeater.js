// File: /assets/js/customizer-repeater.js
jQuery(document).ready(function ($) {
    $('.repeater-control').each(function () {
      const container = $(this);
      const hiddenField = container.nextAll('.repeater-hidden-field').first();
      const fields = JSON.parse(container.attr('data-fields'));
      let data = JSON.parse(hiddenField.val() || '[]');
  
      function renderItems() {
        container.empty();
        $.each(data, function (index, item) {
          const itemDiv = $('<div class="repeater-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;"></div>');
  
          $.each(fields, function (key, options) {
            const value = item[key] || '';
            if (options.type === 'image') {
                const imageWrapper = $('<div class="image-wrapper"></div>');
                if (value) {
                  imageWrapper.append(`<img src="${value}" class="image-preview" style="max-width: 80px; display: block; margin-bottom: 5px;" />`);
                }
                const imageButton = $(`<button class="button select-image" data-key="${key}" data-index="${index}">${value ? 'Change Image' : 'Choose Image'}</button>`);
                imageWrapper.prepend(`<label>${options.label}</label>`);
                imageWrapper.append(imageButton);
                itemDiv.append(imageWrapper);
      
            } else if (options.type === 'select') {
              const select = $('<select class="repeater-input"></select>')
                .attr('data-key', key)
                .attr('data-index', index);
  
              $.each(options.choices, function (val, label) {
                const selected = value === val ? 'selected' : '';
                select.append(`<option value="${val}" ${selected}>${label}</option>`);
              });
  
              itemDiv.append(`<label>${options.label}</label>`).append(select);
            } else {
              itemDiv.append(
                `<label>${options.label}
                  <input type="${options.type}" class="repeater-input" data-key="${key}" data-index="${index}" value="${value}" />
                </label>`
              );
            }
          });
  
          const removeBtn = $('<button class="button remove-repeater-item" style="margin-top: 10px;">Remove</button>');
          removeBtn.on('click', function () {
            data.splice(index, 1);
            renderItems();
          });
  
          itemDiv.append(removeBtn);
          container.append(itemDiv);
        });
  
        hiddenField.val(JSON.stringify(data)).trigger('change');
      }
  
      container.closest('.customize-control').find('.add-repeater').on('click', function () {
        const newItem = {};
        $.each(fields, function (key, options) {
          newItem[key] = '';
        });
        data.push(newItem);
        renderItems();
      });
  
      container.on('change', '.repeater-input', function () {
        const key = $(this).data('key');
        const index = $(this).data('index');
        data[index][key] = $(this).val();
        hiddenField.val(JSON.stringify(data)).trigger('change');
      });
  
      container.on('click', '.select-image', function (e) {
        e.preventDefault();
        const index = $(this).data('index');
        const key = $(this).data('key');
        const frame = wp.media({
          title: 'Select Image',
          button: { text: 'Use this image' },
          multiple: false
        });
  
        frame.on('select', function () {
          const attachment = frame.state().get('selection').first().toJSON();
          data[index][key] = attachment.url;
          renderItems();
        });
  
        frame.open();
      });
  
      renderItems();
    });
  });