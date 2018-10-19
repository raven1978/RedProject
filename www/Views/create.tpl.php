<script type="text/javascript">
    window.onload = GetAll;

        function createEntry()
        {
            var userId = document.getElementById("user_id").value;
            var product_id = document.getElementById("sel1").value;
            var amount = document.getElementById("amount").value;
            var currency = document.getElementById("sel2").value;

            if (userId == '' || amount == '')
            {
                alert("Fields Empty!");
            }
            else {
                var json_text = '{"user_id": ' + userId + ', "product_id": ' + product_id + ', "amount": ' + amount + ', "currency": "' + currency + '"}';

                $.ajax({url: "transactions/", type: 'PUT', data: json_text, async: false, success: function(result) {
                        console.log(result);

                        alert(result.message);

                        location.reload();
                    }});
            }
        }

        function drawResult(result)
        {
            for (var i = 0; i < result.length; i++) {
                $('#sel1').append("<option value=" + result[i].id + ">" + result[i].description + "</option>");
            }
        }

        function GetAll()
        {
            $.ajax({url: "products/", async: false, success: function(result) {
                    console.log(result);
                    drawResult(result);
                }});
        }
</script>
<form class="form-horizontal" action="/action_page.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="user_id">User Id:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="user_id" placeholder="Enter User Id" style="width: 500px;">
    </div>
  </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="sel1">Select Product:</label>
        <div class="col-sm-10">  
            <select class="form-control" id="sel1" style="width: 500px;">
          </select>
        </div>
    </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="amount">Amount:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="amount" placeholder="Enter Amount" style="width: 500px;">
    </div>
  </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="sel2">Select Currency:</label>
        <div class="col-sm-10">  
            <select class="form-control" id="sel2" style="width: 500px;">
                <option value="coins">coins</option>
                <option value="gems">gems</option>
          </select>
        </div>
    </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-default" onclick="createEntry()">Create</button>
    </div>
  </div>
</form>