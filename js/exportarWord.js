$('#word').click(function(e){
    $('#tablaPrOr').tableExport({
        type: 'doc',
        escape: false,
    });
});


// $("body").on("click", "#pdf", function () {
//     html2canvas($('#tablaFODA')[0], {
//         onrendered: function (canvas) {
//             var data = canvas.toDataURL();
//             var docDefinition = {
//                 content: [{
//                     image: data,
//                     width: 500
//                 }]
//              };
//             pdfMake.createPdf(docDefinition).download("matrizFODA.pdf");
//         }
//     });
// });