<script type="text/javascript">
    window.onload = GetAll;

    function deleteEntry(id)
        {
            $.ajax({url: "transactions/" + id, type: 'DELETE', async: false, success: function(result) {
                    console.log(result);

                    alert(result.message);

                    location.reload();
                }});
        }

        function drawResult(result)
        {
            for (var i = 0; i < result.length; i++) {
                $('#target > tbody:last-child').append("<tr><td>"
                        + result[i].user_id + "</td><td>"
                        + result[i].product.description + "</td><td>"
                        + result[i].amount + "</td><td>"
                        + result[i].currency + "</td><td>"
                        + "<a onclick=deleteEntry(" + result[i].id + ") class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\"></i>&nbsp;DELETE</a>");
            }
        }

        function GetAll()
        {
            $.ajax({url: "transactions/", async: false, success: function(result) {
                    console.log(result);
                    drawResult(result);
                }});
        }
</script>
<div id="target"></div>
<div class="container">
  <h2>Current Transactions</h2>
  <p>This is a list of current transactions stored on DB</p>
  <table class="table" id="target">
    <thead>
      <tr>
        <th>User Id</th>
        <th>Product</th>
        <th>Amount</th>
        <th>Currency</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>