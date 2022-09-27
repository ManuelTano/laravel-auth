const placeholder = "stringa https presa da google immagini"
const image = document.getElementById('image')
const preview = document.getElementById('preview')

image.addEventListener('input', () => {
    preview.src = image.value || placeholder;
})
