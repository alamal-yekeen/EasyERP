<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisition Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#itemModal">Add Item</button>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Category</th>
                <th>Item</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="itemTableBody"></tbody>
    </table>

    <button class="btn btn-success" id="saveItems" style="display:none;">Save All</button>
</div>

<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="mb-3">
                        <label>Item Category</label>
                        <input type="text" class="form-control" id="category" required>
                    </div>
                    <div class="mb-3">
                        <label>Item</label>
                        <input type="text" class="form-control" id="item" required>
                    </div>
                    <div class="mb-3">
                        <label>Unit Price</label>
                        <input type="number" class="form-control" id="unitPrice" required>
                    </div>
                    <div class="mb-3">
                        <label>Quantity</label>
                        <input type="number" class="form-control" id="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" class="form-control" id="amount" readonly>
                    </div>
                    <button type="button" class="btn btn-primary" id="addItem">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    let itemList = [];

    // Calculate amount when quantity or unit price changes
    $("#unitPrice, #quantity").on("input", function(){
        let unitPrice = parseFloat($("#unitPrice").val()) || 0;
        let quantity = parseFloat($("#quantity").val()) || 0;
        $("#amount").val(unitPrice * quantity);
    });

    // Add item to table
    $("#addItem").click(function(){
        let category = $("#category").val();
        let item = $("#item").val();
        let unitPrice = $("#unitPrice").val();
        let quantity = $("#quantity").val();
        let amount = $("#amount").val();

        if(category && item && unitPrice && quantity) {
            itemList.push({ category, item, unitPrice, quantity, amount });

            let newRow = `<tr>
                <td>${category}</td>
                <td>${item}</td>
                <td>${unitPrice}</td>
                <td>${quantity}</td>
                <td>${amount}</td>
                <td><button class="btn btn-danger btn-sm removeItem">Remove</button></td>
            </tr>`;

            $("#itemTableBody").append(newRow);
            $("#saveItems").show();
            $("#itemForm")[0].reset();
            $("#amount").val('');
            $("#itemModal").modal("hide");
        }
    });

    // Remove item from table
    $(document).on("click", ".removeItem", function(){
        $(this).closest("tr").remove();
        if ($("#itemTableBody tr").length === 0) {
            $("#saveItems").hide();
        }
    });

    
    // Save items to database
    $("#saveItems").click(function(){
        alert(itemList);
        $.post("save.php", { items: itemList }, function(response){
            alert(response);
            location.reload();
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
