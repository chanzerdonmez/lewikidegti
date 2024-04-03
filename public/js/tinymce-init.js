{/* <script src="/bundles/tinymce/ext/tinymce/tinymce.min.js"></script>

    tinymce.init({
        selector: '.tinymce',
        plugins: 'image filemanager link', // Ajoutez le plugin 'link' à la liste des plugins activés
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | filemanager | link | exportpdf', // Ajoutez le bouton 'link' à la barre d'outils

        file_picker_callback: function(cb, value, meta) {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            // Event listeners
            input.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    // Handle data processing with a blob
                    const id = 'blobid' + (new Date()).getTime();
                    const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    const base64 = reader.result.split(',')[1];
                    const blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                });
                reader.readAsDataURL(file);
            });
            input.click();
        },
        images_reuse_filename: true,
        paste_data_images: true,

        // content_css: '/style.css',

        setup: function (editor) {

            // Ajoutez la fonction pour exporter en PDF avec html2pdf
            editor.ui.registry.addButton('exportpdf', {
                text: 'Exporter au format PDF',
                onAction: function () {
                    exportToPDF(editor.getContent());
                }
            });
        }
    });

    function exportToPDF(content) {
        var element = document.createElement('div');
        element.innerHTML = content;

        html2pdf(element, {
            margin: 10,
            filename: 'output.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        });
    } */}
