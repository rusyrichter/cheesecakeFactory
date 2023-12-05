<?php include 'header.php'; ?>
   

<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $email =  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $baseFlavor = $_POST['baseFlavor'];
        $specialRequest = $_POST['specialRequests'];
        $quantity = $_POST['quantity'];
        $date = $_POST['date'];
        $total = $_POST['totalInput'];   
        $toppings = isset($_POST['selectedToppings']) ? explode(',', $_POST['selectedToppings']) : [];
        $toppingsString = implode(", ", $toppings);

        $sql = "INSERT INTO cheesecake (name, email, baseFlavor, specialRequest, quantity, datetime, total, toppings) 
        VALUES ('$name', '$email', '$baseFlavor', '$specialRequest', '$quantity', '$date', '$total', '$toppingsString')";
        if (mysqli_query($conn, $sql)) {
          header('Location: success.php');
        } else {
          echo 'Error: ' . mysqli_error($conn);
        };
    }

?>

<script>

let toppings = [];
let name = "";
let email = "";
let baseFlavor = "";
let specialRequest = "";
let quantity = null;
let date = null;
let total = null;

const onToppingsChange = e => {
    const toppingName = e.target.name;
    if (toppings.includes(toppingName)) {
       toppings = toppings.filter(t => t !== toppingName);
    } else {
        toppings = [...toppings, toppingName];
    }
    document.getElementById('toppingsText').textContent = toppings.join(', ');
    document.getElementById('selectedToppingsInput').value = toppings.join(',');
};
const onNameChange = e => {
    name = e.target.value;
    document.getElementById('nameTitle').textContent = name + "'s Custom Cheesecake";
    document.getElementById('nameTitle').value = name;
};
const onEmailChange = e => {
    email = e.target.value;
};
const onFlavorChange = e => {
    baseFlavor = e.target.value;
    document.getElementById('baseFlavorText').textContent = baseFlavor;
    document.getElementById('baseFlavorText').value = baseFlavor;

};
const onSpecialRequestChange = e => {
    specialRequest = e.target.value;
    document.getElementById('specialRequestText').textContent =specialRequest;
    document.getElementById('specialRequestText').value =specialRequest;

}
const onQuantityChange = e => {
    quantity = e.target.value;
    document.getElementById('quantityText').textContent =quantity;
    document.getElementById('quantityText').value =quantity;

    getTotal();
}
const onDateChange = e => {
    date = e.target.value;
    document.getElementById('dateText').textContent =date;
    document.getElementById('dateText').value =date;

}

function getTotal(){
    total = (49.99 + (toppings.length * 3.95)) * quantity;
    total = parseFloat(total.toFixed(2));
    document.getElementById('totalText').textContent = total;
    document.getElementById('totalInput').value = total;

};

    </script>
        <form method="POST" action="<?php echo htmlspecialchars(
            $_SERVER['PHP_SELF']
            ); ?>" class="mt-4 w-75">
        <div>
        <div class="container" style="margin-top: 80px;">
            <h1 class="text-center my-4">Cheesecake Factory Order Form</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" onchange="onNameChange(event)"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" onchange="onEmailChange(event)"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cheesecake Base Flavor ($49.99)</label>
                        <select class="form-select" name="baseFlavor" onchange="onFlavorChange(event)">
                            <option> Choose...</option>
                            <option>Classic</option>
                            <option>Chocolate</option>
                            <option>Red Velvet</option>
                            <option>Brownie</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Toppings (each topping adds an additional $3.95)</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Chocolate Chips" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Chocolate Chips</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Caramel Drizzle" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Caramel Drizzle</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Whipped Cream" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Whipped Cream</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Pecans" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Pecans</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Almonds" value="Almonds" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Almonds</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Toasted Coconut" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Toasted Coconut</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Graham Cracker Crumble" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Graham Cracker Crumble</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Cookie Dough" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Cookie Dough</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Mint Chocolate Chips" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Mint Chocolate Chips</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Caramelized Bananas" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Caramelized Bananas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Rainbow Sprinkles" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Rainbow Sprinkles</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Powdered Sugar" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Powdered Sugar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="White Chocolate Shavings" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">White Chocolate Shavings</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Peanut Butter Drizzle" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Peanut Butter Drizzle</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Dark Chocolate Drizzle" onchange="onToppingsChange(event)"/>
                            <label class="form-check-label">Dark Chocolate Drizzle</label>
                        </div>
                        <input type="hidden" name="selectedToppings" id="selectedToppingsInput">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Special Requests</label>
                        <textarea class="form-control" rows="3" name="specialRequests" onchange="onSpecialRequestChange(event)"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" min="1" name="quantity" onchange="onQuantityChange(event)"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Delivery Date</label>
                        <input type="date" class="form-control" onchange="onDateChange(event)" name="date" />
                    </div>
                    <button type="submit" id="submitButton" class="btn btn-primary" onclick="onSubmitClick()">Submit Order</button>
                </div>
                <div class="col-md-6 position-sticky">
                    <h2 class="mb-4">Live Preview</h2>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" id="nameTitle">Custom Cheesecake</h5>
                            <p class="card-text">Base: <span id="baseFlavorText"></span></p>
                            <p class="card-text">Toppings: <span id="toppingsText"></span></p>
                            <p class="card-text">Special Requests: <span id="specialRequestText"></span></p>
                            <p class="card-text">Quantity: <span id="quantityText"></span></p>
                            <p class="card-text">Delivery Date: <span id="dateText"></span></p>
                            <p class="card-text fw-bold">Total: <span id="totalText"></p>
                            <input type="hidden" name="totalInput" id="totalInput">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



