            $("#filtro").keyup(function() {
                var data = this.value.split(" ");
                var jo = $("#filtrar").find("tr");
                if (this.value == "") {
                    jo.show();
                    return;
                }
                jo.hide();

                jo.filter(function(i, v) {
                    var $t = $(this);
                    for (var d = 0; d < data.length; ++d) {
                        if ($t.is(":contains('" + data[d] + "')")) {
                            return true;
                        }
                    }
                    return false;
                })
                        .show();
            }).focus(function() {
                this.value = "";
                $(this).css({
                    "color": "black"
                });
                $(this).unbind('focus');
            }).css({
                "color": "#C0C0C0"
            });