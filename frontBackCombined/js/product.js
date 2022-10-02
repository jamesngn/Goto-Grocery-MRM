$(document).ready(function () {
    $('#example').DataTable({
        'columnDefs': [{ 'orderable': false, 'targets': 0 }], // hide sort icon on header of first column
        'columnDefs': [{ 'orderable': false, 'targets': 6 }],
     'aaSorting': [[1, 'asc']] // start to sort data in second column 
    });
});