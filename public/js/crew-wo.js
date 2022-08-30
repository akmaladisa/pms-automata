$(document).ready(function() {

    $('#crew_wo_add_btn_modal').on('click', function (e) {
        e.preventDefault();
        
        remove_required_attribute_from_crew_master_modal_edit_input()
        remove_required_attribute_from_crew_master_modal_input()

        $('#add-crew-wo-modal').modal('show')
    });

    $('#add-crew-wo-modal').on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

})