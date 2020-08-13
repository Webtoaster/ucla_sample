import '../css/ui_security.scss';


$('.custom-file-input').on('change', (event) => {
  const dataFile = event.currentTarget;
  $(dataFile).parent()
    .find('.custom-file-label')
    .html(dataFile.files[0].name);
});
