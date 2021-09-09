CKEDITOR.editorConfig = function(config){
    // config.uiColor = '#AADC6E';
    config.toolbar = 'MyBasic';
    config.toolbar_Ques =[
    {name: 'wirisplugins', items: ['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry']},
    { name: 'document', items : ['Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'] },
    { name: 'clipboard', items : ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'] },
    { name: 'editing', items : ['Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'] },
    { name: 'forms', items : ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },
    { name: 'basicstyles', items : ['Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'] },
    { name: 'links', items : ['Link','Unlink','Anchor'] },
    { name: 'colors', items : ['TextColor','BGColor'] },
    '/',
    { name: 'insert', items : ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'] },
    { name: 'paragraph', items : ['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl'] },
    { name: 'styles', items : ['Styles','Format','Font','FontSize'] },
    ];
    // config.uiColor = '#AADC6E';
    config.toolbar = 'MyBasicEvalution';
    config.toolbar_Evalution =[
    {name: 'wirisplugins', items: ['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry']},
    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline' ] },
    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    ];
};