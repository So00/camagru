{
    var filter = document.getElementsByClassName("filter");
    for (var i = 0; i < filter.length; i++)
    {
        filter[i].addEventListener('click', function (e){
            var act = e.target.cloneNode();
            video = document.body.querySelector("#vidContainer");
            var nb_filter = document.getElementsByClassName("activeFilter").length;
            act.style.position = "absolute";
            act.style.top = "0";
            act.style.left = "0";
            act.style.width = "30%";
            act.className = "activeFilter filter_" + nb_filter;
            act.addEventListener('mousedown', function (e){
                var actPosX = e.target.style.left;
                var actPosY = e.target.style.top;
                var done = 0;
                act.addEventListener('mouseup', function (ev) {
                    if (actPosX === ev.target.style.left && actPosY === ev.target.style.top && !done){
                        if (ev.target.style.width === "100%")
                            ev.target.style.width = "10%";
                        else
                            ev.target.style.width = (parseInt(ev.target.style.width) + 10) + "%";
                        done = 1;
                    }
                });
            });
            video.appendChild(act);
            
            var dragItem = document.querySelector(".filter_" + nb_filter);
            var container = document.querySelector("#vidContainer");
            
            var active = false;
            var currentX;
            var currentY;
            var initialX;
            var initialY;
            var xOffset = 0;
            var yOffset = 0;
            
            container.addEventListener("touchstart", dragStart, false);
            container.addEventListener("touchend", dragEnd, false);
            container.addEventListener("touchmove", drag, false);
            
            container.addEventListener("mousedown", dragStart, false);
            container.addEventListener("mouseup", dragEnd, false);
            container.addEventListener("mousemove", drag, false);
            
            function dragStart(e) {
                if (e.type === "touchstart") {
                    initialX = e.touches[0].clientX - xOffset;
                    initialY = e.touches[0].clientY - yOffset;
                } else {
                    initialX = e.clientX - xOffset;
                    initialY = e.clientY - yOffset;
                }
                
                if (e.target === dragItem) {
                    active = true;
                }
            }
            
            function dragEnd(e) {
                initialX = currentX;
                initialY = currentY;
                
                active = false;
            }
            
            function drag(e) {
                if (active) {
                    
                    e.preventDefault();
                    
                    if (e.type === "touchmove") {
                        currentX = e.touches[0].clientX - initialX;
                        currentY = e.touches[0].clientY - initialY;
                    } else {
                        currentX = e.clientX - initialX;
                        currentY = e.clientY - initialY;
                    }
                    
                    xOffset = currentX;
                    yOffset = currentY;
                    
                    move(currentX, currentY, dragItem);
                }
            }
            
            function move(xPos, yPos, el) {
                var container = el.parentNode;
                el.style.top = (100 * yPos / parseInt(container.style.height)) + "%";
                el.style.left = (100 * xPos / parseInt(container.style.width))+ "%";
            }
        }
    )
}
}