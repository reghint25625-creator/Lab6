import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.css';
import duallistbox from 'bootstrap4-duallistbox';
import 'bootstrap4-duallistbox/dist/bootstrap-duallistbox.css';

window.$ = window.jQuery = $;

select2(window, $);
duallistbox(window, $);

$(function () {
    $('#works_select').select2({
        width: '100%',
        placeholder: 'Оберіть роботи СТО',
    });

    $('#duallist').bootstrapDualListbox({
        nonSelectedListLabel: 'Доступні роботи',
        selectedListLabel: 'Обрані роботи',
        preserveSelectionOnMove: 'moved',
        moveOnSelect: false,
        infoText: 'Усього {0}',
        filterPlaceHolder: 'Пошук роботи',
    });
});
