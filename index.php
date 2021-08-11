<html lang="en">

<head>
    <title>Pencarian Pesantren</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $.ajax({
            url: "https://dev.farizdotid.com/api/daerahindonesia/provinsi",
            type: "GET",
            success: function(resp) {
                var cb = $("#provinsi");
                cb.empty();
                cb.append($('<option></option>').val("").text("Pilih Provinsi"));
                for (var i = 0; i < resp.provinsi.length; i++)
                    cb.append($('<option></option>').val(resp.provinsi[i].id).text(resp.provinsi[i].nama));
            }
        });

        $(function() {
            $("#provinsi").change(function() {
                var id_provinsi = $("#provinsi option:selected").val();
                $.ajax({
                    url: "https://dev.farizdotid.com/api/daerahindonesia/kota",
                    type: "GET",
                    data: "id_provinsi=" + id_provinsi,
                    success: function(resp) {
                        var cb = $("#kabkot");
                        cb.empty();
                        cb.append($('<option></option>').val("").text("Pilih Kabupaten/Kota"));
                        for (var i = 0; i < resp.kota_kabupaten.length; i++)
                            cb.append($('<option></option>').val(resp.kota_kabupaten[i].id).text(resp.kota_kabupaten[i].nama));
                        // }
                    }
                });
            });
        });

        $(function() {
            $("#kabkot").change(function() {
                var id_kabkot = $("#kabkot option:selected").val();
                $.ajax({
                    url: "https://api-pesantren-indonesia.vercel.app/pesantren/" + id_kabkot + ".json",
                    type: "GET",
                    success: function(resp) {
                        console.log(resp)
                        var cb = $("#tbody");
                        cb.empty();
                        for (var i = 0; i < resp.length; i++)
                            cb.append($('<tr><td>' + resp[i].nama + '</td><td>' + resp[i].nspp + '</td><td>' + resp[i].alamat + '</td><td>' + resp[i].kyai + '</td></td></tr>'));
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="col">
            <div class="row">
                <h1>Pencarian Pesantren</h1>

            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form action="">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="form-control" id="provinsi">
                                        <option>Pilih Provinsi</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kabkot">Kabupaten/Kota</label>
                                    <select class="form-control" id="kabkot">
                                        <option>Pilih Kabupaten/Kota</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <h5>Sumber :</h5>
                            <h6>Api Lokasi : <a href="https://farizdotid.com/blog/dokumentasi-api-daerah-indonesia/">farizdotid</a></h6>
                            <h6>Api Pesantren : <a href="https://github.com/nasrul21/data-pesantren-indonesia">nasrul21</a></h6>
                        </div>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nama Pesantren</th>
                            <th scope="col">NSPP</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kyai</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</body>

</html>