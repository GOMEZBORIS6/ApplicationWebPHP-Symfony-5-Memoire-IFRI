$(document).on('change', '#forms_classeetudiant, #forms_ue', function () 
{
   let $field = $(this)
   let $classeetudiantField = $('#forms_classeetudiant')
   let $form = $field.closest('form')
   let target = '#' + $field.attr('id').replace('ue', 'ecue').replace('classeetudiant','ue')
   let data = {}
   data[$classeetudiantField.attr('name')] = $classeetudiantField.val()
   data[$field.attr('name')] = $field.val()
   //debugger
   $.post($form.attr('action'), data).then(function(data) {
       //debugger
       let $input = $(data).find(target)
       $(target).replaceWith($input)
   })
})