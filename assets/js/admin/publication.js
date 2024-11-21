crud.field('publication_type').onChange(function (field) {
    crud.field('pdf_file').hide()
    crud.field('url').hide()


    if (field.value === 'file') {

        crud.field('pdf_file').show()
        crud.field('url').hide()
    } else if (field.value === 'url') {

        crud.field('pdf_file').hide()
        crud.field('url').show()
    }

}).change()
