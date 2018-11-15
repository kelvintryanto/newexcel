@extends('admin.layout.auth')

@section('content')
<div class="container" style="margin-left: 0px; margin-right: 0px; padding: 15px; width: 100%;">
    <div class="row">
        <div class="col-md-12">
             @if(\Session::has('alert-failed'))
                <div class="alert alert-failed">
                    <div>{{Session::get('alert-failed')}}</div>
                </div>
                @endif
                @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
                @endif
            <div>
                <form action="{{route('sendEmail')}}" method="POST">
                <input hidden name="nama" type="text" id="nama">
                <input hidden name="gaji" type="text" id="gaji">
                <input hidden name="email" type="text" id="email">
                {{ csrf_field() }}
                    <table id="table" class="table table-hover" style="font-size: 12px;">
                        <tr>
                            <th>Nama</th>
                            <th>Gaji</th>
                            <th>Email</th>
                            <th>Send Email</th>
                        </tr>
                        <?php
                        $conn=mysqli_connect("localhost","root","","newexcel");
                        if($conn->connect_error){
                            die("Connection failed:". $conn-> connect_error);
                        }
                        $sql = "SELECT nama,ptkp,email from karyawan, users WHERE karyawan.nama = users.name";
                        $result = $conn-> query($sql);


                        if ($result-> num_rows > 0) {
                            while ($row = $result-> fetch_assoc()) {
                                echo '<tr><td id="nama">'.$row["nama"].'</td>
                                    <td id="ptkp" data-id1="'.$row["nama"].'">'.$row["ptkp"].'</td>
                                    <td id="email" data-id2="'.$row["nama"].'">'.$row["email"].'</td>
                                    <td><button name="btn_send" id="btn_send" data-id4="'.$row["nama"].'">send</button></td></tr>';


                               /* echo "<tr><td>".$row["nama"]."</td><td>".$row["ptkp"]."</td><td>".$row["email"]."</td><td>"."<button name="btn_send" id="btn_send" data-id3="'.$row["name"].'">send</button>"."</td></tr>";*/
                               
                            }
                            echo "</table>";

                        }
                        else{
                            echo "0 result";
                        }
                        $conn-> close();
                        ?> 


                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    var table = document.getElementById('table'),rIndex;
    for(var i = 0; i < table.rows.length;i++)
    {
        table.rows[i].onclick=function()
        {
            rIndex = this.rowIndex;
            document.getElementById("nama").value = this.cells[0].innerHTML;
            document.getElementById("gaji").value = this.cells[1].innerHTML;
            document.getElementById("email").value = this.cells[2].innerHTML;
        }
    }

    $(".alert-success").fadeTo(1000, 500).slideUp(500, function()
    {
        $(".alert-success").slideUp(500);
    });
</script>

@endsection