function DeleteVendorRowTable(i) {
    var p = i.parentNode.parentNode;
    p.parentNode.removeChild(p);
}

$(document).on("click", "#new_row", function () {
    addRow();

    var route = $(".route").attr("data-route");

    // make products select searchable
    $(".products").select2({
        theme: "classic",
        allowClear: true,
        width: "resolve",
        placeholder: "Choose products...",
        minimumInputLength: 2,
        ajax: {
            url: route,
            dataType: "json",
            data: function (params) {
                return {
                    part_of_name: $.trim(params.term),
                };
            },
            processResults: function (data) {
                return {
                    results: data,
                };
            },
            cache: true,
        },
    });
});

function addRow() {
    $("#details-table tbody ").append(
        `<tr>
        <td>
          <select name="product_id[]" data-route="{{ route('shop.search-by-name') }}"
           class="form-control products "><option value="">products</option>
            </select>
        </td>

        <td>
            <input name="manual_product_name[]" id="manual_product_name" class="form-control m-input"
                 />
        </td>

        <td>
            <input name="price[]" id="price" placeholder="Enter Price" class="form-control m-input" step="0.1"
                type="number" />
        </td>

        <td>
            <input name="quantity[]"  placeholder="Enter Quantity" class="form-control m-input"
                type="number" />
        </td>


        <td>
            <a title="Remove the row" class="btn btn-sm btn-danger" onclick="DeleteVendorRowTable(this)">
                <i class="fa fa-times" style="color: #fff"></i>
            </a>
        </td>
    </tr>`
    );
}
