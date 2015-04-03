$(window).load(function() {
    $.ajax({
            type: "GET",
            url: "/include/showaccount.php",
            dataType: "json",
            success: function(data) {
                var name = document.createElement("p");
                var email = document.createElement("p");
                var bio = document.createElement("p");
                var totalTime = document.createElement("p");
                var tmp;

                console.log(data);

                name.textContent = JSON.stringify(data["Name"]).replace(/\"/g, "");
                email.textContent = JSON.stringify(data["Email"]).replace(/\"/g, "");
                bio.textContent = JSON.stringify(data["Bio"]).replace(/\"/g, "");
                tmp = JSON.stringify(data["totalTime"]).replace(/\"/g, "");
                tmp = parseFloat(tmp/3600).toFixed(2);
                totalTime.textContent = tmp;

                var array;
                array = [name, email, bio, totalTime];

                for (var i = 0; i < array.length; i++) {
                    var h4abi = document.getElementsByTagName("h4").item(i);
                    h4abi.parentNode.insertBefore(array[i], h4abi.nextSibling);
                }
            }
        }
    )
});
