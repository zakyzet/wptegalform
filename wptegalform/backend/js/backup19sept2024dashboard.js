jQuery(function ($) {

  const $formPreview = $("#fb-preview"),
    $formSubmission = $("#form-submission"),
    $fbEditor = $("#fb-editor");

  // Set default form data if 'id' is set in the query parameters
  // const defaultFormData = <?php echo isset($_GET['id']) ? json_encode(get_post_field('post_content', $_GET['id'])) : "''"; ?>;

  // Hide the form preview by default
  $formPreview.hide();

  const fbOptions = {
    onSave: function () {
      $fbEditor.toggle();

      // Update the form with ID 'preview' using formRender
      $("#preview").formRender({
        formData: formBuilder.formData,
      });

      // Update the textarea with ID 'post_content' in the form with ID 'submission'
      $("#form_content").val(formBuilder.formData);

      console.log("Form Data:", formBuilder.formData);

      // Hide "Save form" button and show "#editData" button
      $("#saveData").hide();
      $("#editData").show();
      $formPreview.show();
    },
  };

  const formBuilder = $fbEditor.formBuilder({
    /*

autocomplete
button
checkbox-group
date
file
header
hidden
number
paragraph
radio-group
select
starRating
text
textarea
*/
    controlOrder: [
      "header",
      "paragraph",
      "text",
      "textarea",
      "select",
      "checkbox-group",
      "radio-group",
      "date",
      "number",
      "hidden",
    ],

    disabledAttrs: [
      "access",
      "className",
      // 'description',
      // 'inline',
      // 'label',
      // 'max',
      "maxlength",
      "min",
      "multiple",
      "name",
      // 'options',
      // 'other',
      "placeholder",
      "required",
      // 'rows',
      // 'step',
      "style",
      // 'subtype',
      // 'toggle',
      // 'value'
    ],

    disabledSubtypes: {
      text: ["password"],
    },
    scrollToFieldOnAdd: true,
    //  showActionButtons: false,
    // Include default form data here
    // formData: defaultFormData,
    disableFields: ["autocomplete", "file", "button"],
    ...fbOptions,
  });

  $("#editData").on("click", function () {
    $fbEditor.toggle();
    $("#saveData").show();
    $formPreview.hide();
    $(this).hide();
  });

  document
    .getElementById("saveData")
    .addEventListener("click", () => formBuilder.actions.save());
    
  
});