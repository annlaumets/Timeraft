$(window).load(function() {
    $.ajax({
            type: "GET",
            url: "/include/showAccount.php",
            dataType: "json",
            success: function(data) {
                console.log(JSON.stringify(data));
                var name = document.createElement("p");
                var email = document.createElement("p");
                var bio = document.createElement("p");
                var totalTime = document.createElement("p");

                var hour = Math.floor(data["totalTime"] / 3600);
                var min = Math.floor((data["totalTime"] / 3600 - hour) * 60);
                var sec = Math.round(((data["totalTime"] / 3600 - hour) * 60 - min) * 60);

                name.textContent = JSON.stringify(data["Name"]).replace(/\"/g, "");
                email.textContent = JSON.stringify(data["Email"]).replace(/\"/g, "");
                bio.textContent = JSON.stringify(data["Bio"]).replace(/\"/g, "");
                totalTime.textContent = hour + " hours " + min + " minutes " + sec + " seconds";

                var array;
                array = [name, email, bio, totalTime];

                for (var i = 0; i < array.length; i++) {
                    var h4abi = document.getElementsByTagName("h4").item(i);
                    h4abi.parentNode.insertBefore(array[i], h4abi.nextSibling);
                }

                if (data["Filepath"] != null) {
                    document.getElementById('profile').src = data["Filepath"];
                }
                else {
                    document.getElementById('profile').src = "../images/placeholder.png";
                }

                sessionStorage.setItem("AccountName", name.textContent);
                sessionStorage.setItem("AccountEmail", email.textContent);
                sessionStorage.setItem("AccountBio", bio.textContent);
                sessionStorage.setItem("AccountTime", totalTime.textContent);
            },
            error: function(data) {
                alert("JSJUSJISJId");
                console.log(JSON.stringify(data));
                var name = document.createElement("p");
                var email = document.createElement("p");
                var bio = document.createElement("p");
                var totalTime = document.createElement("p");

                name.textContent = sessionStorage.getItem("AccountName");
                email.textContent = sessionStorage.getItem("AccountEmail");
                bio.textContent = sessionStorage.getItem("AccountBio");
                totalTime.textContent = sessionStorage.getItem("AccountTime");

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
