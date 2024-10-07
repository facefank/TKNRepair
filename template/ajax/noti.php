<script>
    document.addEventListener('DOMContentLoaded', function () {
        if(!Notification){
            alert('Desktop notifications not available in your browser. Try Chromium.'); 
            return;
        }
        if (Notification.permission !== "granted")
             Notification.requestPermission();
        });
</script>
<?php
    $connect = new mysqli("localhost", "root", "", "tkncoth_repair") or die( mysqli_connect_error());
    $query = "SELECT * FROM rp_it WHERE repair_new = 'YES'";
    $result = $connect->query($query) or die ($connect->error);

    while($row = $result->fetch_assoc()){
        if($row["repair_id"] != ""){
?>
<script>
        // setInterval(
        window.onload = function notifyMe() {
            if (Notification.permission !== "granted")
                Notification.requestPermission();
            else{
                var notification = new Notification('แจ้งซ่อมใหม่', {
                    icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                    body: "แจ้งซ่อม<?php echo $row["repair_acc"] ?>",
                });

                notification.onclick = function () {
                    window.open("https://10.4.22.209/repair2/template/home?&p=search&q=<?php echo $row["repair_id"] ?>&n=set_default");      
                };
            }
        }
         // , 60000);   // 1000 = 1 second
    </script>
<?php
            // $query2 = "UPDATE rp_it SET repair_new = 'NO' WHERE repair_new = 'YES'";
            // $result2 = $connect->query($query2) or die ($connect->error);        
        }
    }
?>