function changeStatus(url, targetId) {
  if (confirm("Are you sure to Change Status?")) {
      $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
              // Handle the response here, e.g., update button text or styles
              $('#'+targetId).html(response);
              $('.datatable').DataTable().ajax.reload();
          },
          error: function(xhr, status, error) {
              console.error(xhr.responseText);
          }
      });
  } 
  else {
    console.log("Action canceled by user");
    $('.datatable').DataTable().ajax.reload();
}
}

function delete_entity(url, targetId)
{
    if (confirm("Are you sure to Delete?")) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                // Handle the response here, e.g., update button text or styles
                // $('#'+targetId).html(response);
                $('.datatable').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}

function reloadDataTable() {
    table.ajax.reload(null, false);
}

// Handle the click event on the delete button
$('.datatable').on('click', '.btn-delete', function() {
    var itemId = $(this).data('id');

    $.ajax({
        url: '{{ route("catelog.delete", ["id" => ":id"]) }}'.replace(':id', itemId),
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                // Reload the DataTable after successful deletion
                reloadDataTable();
                // Optionally, show a success message to the user
                toastr.success(response.message);
            } else {
                // Optionally, handle the case where deletion was not successful
                console.error(response.message);
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error) {
            // Handle errors, e.g., show an error message
            console.error(error);
            toastr.error('Error occurred while deleting the item');
        }
    });
});


function editForm(url_name, target_id, method = "GET", table_id = "") {
     // preloader("", target_id);
    // getting the button of the form and passing into the preloader function
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(target_id).innerHTML = this.responseText;
      //  underscore_remover();
     // stopPreloader("", target_id);
      }
    };
    if (table_id != "") {
      url_name = url_name + "?id=" + table_id;
    }
    xhttp.open(method, url_name, true);
    xhttp.send();
  }

  
  function selectDrop(form_id, url_name, target_id, method = "POST") {
    // getting the all from form
    var form = document.getElementById(form_id);
    // var url_name = form.action;
    if (target_id == "") {
      target_id = form_id;
    }
    // setting all input into the forData object
    var formdata = new FormData(form);
    var formElements_button = Array.from(form.elements).pop();
    // getting the button of the form and passing into the preloader function
    preloader(formElements_button);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // document.getElementById(target_id).innerHTML = this.responseText;
  
        document.getElementById(target_id).value = this.responseText;
        document.getElementById(target_id).innerHTML = this.responseText;
  
        stopPreloader(formElements_button);
      }
      method;
    };
    xhttp.open(method, url_name, true);
    xhttp.send(formdata);
  }
  
  function preloader(element_data, id = "") {
    var element = "";
    if (id != "") {
      element = document.getElementById(id);
    } else {
      element = element_data;
    }
  
    element.disabled = true;
    createdd_element = createMenuItem("span", {
      name: "",
      class: "spinner-border spinner-border-sm",
      id: "lol",
      size: "20px",
    });
    element.appendChild(createdd_element);
  }
  
  function stopPreloader(element_data, child, id = "") {
    var element = "";
    if (id != "") {
      element = document.getElementById(id);
    } else {
      element = element_data;
    }
    if(element.firstElementChild){
      element.removeChild(element.firstElementChild);
    }
    element.disabled = false;
  }