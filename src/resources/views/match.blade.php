<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">

    <title>ChatAI</title>
</head>
<body>

<a href="{{ url('/products') }}" class="button"><i class="fa fa-angle-left"></i> Continue Shopping</a>
<a href="{{ url('/cart') }}" class="button">Cart</a>
<a href="{{ url('/home') }}" class="button">Back To Home</a>

<div class="container">
    @if (session('cart') && is_array(session('cart')))
        @foreach (session('cart') as $id => $details)
            <div class="element" style="width: 400px; height: 400px;">
                <img src="{{ url('uploads/products/'.$details['image']) }}" class="card-img-top" />
                <div class="resize-handle"></div> <!-- Resize handle -->
            </div>
        @endforeach
    @endif
</div>
<div class="chat">

  <!-- Header -->
  <div class="top">
    <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
    <div>
      <p>Chat with ChatAI</p>
      <small>Online</small>
    </div>
  </div>
  <!-- End Header -->

  <!-- Chat -->
  <div class="messages">
    <div class="left message">
      <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
      <p>Start chatting with Chat GPT AI below!!</p>
    </div>
  </div>
  <!-- End Chat -->
  <!-- Footer -->
  <div class="bottom">
    <form>
      <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
      <button type="submit"></button>
    </form>
  </div>
  <!-- End Footer -->

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $("form").submit(function(event) {
        event.preventDefault();

        $("form #message").prop('disabled', true);
        $("form button").prop('disabled', true);
        $.ajax({
            url: "/chat",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            data: {
                "content": $("form #message").val()
            }
        }).done(function(res) {
            // Populate sending message
            $(".messages > .message").last().after('<div class="right message">' +
                '<p>' + $("form #message").val() + '</p>' +
                '<img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">' + '</div>');
            // Populate receiving message
            $(".messages > .message").last().after('<div class="left message">' +
                '<img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">' + '<p>' + res.choices[0].message.content + '</p>' +
                '</div>');
            // Cleanup
            $("form #message").val('');
            $(document).scrollTop($(document).height());
            // Enable form
            $("form #message").prop('disabled', false);
            $("form button").prop('disabled', false);
        });
    });



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<script>
  $("form").submit(function (event) {
    event.preventDefault();

    //Stop empty messages
    if ($("form #message").val().trim() === '') {
      return;
    }

    //Disable form
    $("form #message").prop('disabled', true);
    $("form button").prop('disabled', true);

    $.ajax({
      url: "/chat",
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      },
      data: {
        "model": "gpt-3.5-turbo",
        "content": $("form #message").val()
      }
    }).done(function (res) {

      //Populate sending message
      $(".messages > .message").last().after('<div class="right message">' +
        '<p>' + $("form #message").val() + '</p>' +
        '<img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">' +
        '</div>');

      //Populate receiving message
      $(".messages > .message").last().after('<div class="left message">' +
        '<img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">' +
        '<p>' + res + '</p>' +
        '</div>');

      //Cleanup
      $("form #message").val('');
      $(document).scrollTop($(document).height());

      //Enable form
      $("form #message").prop('disabled', false);
      $("form button").prop('disabled', false);
    });
  });

    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll(".element");
        let chooseElement;
        let isResizing = false;
        let startX;
        let startY;
        let startWidth;
        let startHeight;

        elements.forEach(element => {
            const resizeHandle = element.querySelector(".resize-handle");

            resizeHandle.addEventListener("mousedown", function(event) {
                event.stopPropagation();
                isResizing = true;
                chooseElement = element;
                startX = event.clientX;
                startY = event.clientY;
                startWidth = parseInt(document.defaultView.getComputedStyle(chooseElement).width, 10);
                startHeight = parseInt(document.defaultView.getComputedStyle(chooseElement).height, 10);
            });

            element.addEventListener("mousedown", function(event) {
                event.stopPropagation();
                chooseElement = element;
                document.onmousemove = function(event) {
                    if (!isResizing) {
                        var x = event.pageX;
                        var y = event.pageY;
                        chooseElement.style.left = x - 120 + "px";
                        chooseElement.style.top = y - 120 + "px";
                    }
                };
            });

            // Move the clicked element to the bottom when clicked
            element.addEventListener("click", function() {
                const elements = document.querySelectorAll(".element");
                elements.forEach(el => {
                    el.style.zIndex = 1000; // Reset z-index for all elements
                });
                chooseElement.style.zIndex = 999; // Move the clicked element to the bottom
            });
        });

        document.addEventListener("mouseup", function() {
            isResizing = false;
            document.onmousemove = null; // Remove mousemove event listener when mouse is released
        });

        document.addEventListener("mousemove", function(event) {
            if (!isResizing) return;
            const width = startWidth + (event.clientX - startX);
            const height = startHeight + (event.clientY - startY);
            chooseElement.style.width = width + "px";
            chooseElement.style.height = height + "px";
        });
    });
</script>

</body>
</html>