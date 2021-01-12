
$("body").on("click", "#pdf", function () {
    html2canvas($('#tablaPrOr')[0], {
        onrendered: function (canvas) {
            var data = canvas.toDataURL();
            var docDefinition = {
                content: [{
                    image: data,
                    width: 500
                }]
             };
            pdfMake.createPdf(docDefinition).download("matrizPrOr.pdf");
        }
    });
});