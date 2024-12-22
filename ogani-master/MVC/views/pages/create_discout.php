<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Discount</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* Hai cột bằng nhau */
            gap: 40px;
            /* Tăng khoảng cách giữa các cột */
            max-width: 900px;
            margin: 0 auto;
        }

        form section {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        button {
            grid-column: span 2;
            /* Nút bấm kéo dài cả hai cột */
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .full-width {
            grid-column: span 2;
            /* Trường kéo dài cả hai cột */
        }
    </style>
   <script>
function saveDiscount() {
    // Lấy dữ liệu từ form
    const discountData = {
        code: document.getElementById('code').value,
        name: document.getElementById('name').value,
        maxUses: document.getElementById('maxUses').value,
        maxUsesUser: document.getElementById('maxUsesUser').value,
        discountAmount: document.getElementById('discountAmount').value,
        minAmount: document.getElementById('minAmount').value,
        status: document.getElementById('status').value,
        startsAt: document.getElementById('startsAt').value,
        expiresAt: document.getElementById('expiresAt').value,
        description: document.getElementById('description').value,
        type: document.getElementById('type').value,
    };

    // Lưu vào cookie
    document.cookie = `discountData=${JSON.stringify(discountData)}; path=/`;

    // Điều hướng đến controller
    window.location.href = "/dashboardcontroller/CreateDiscount";
}
</script>
</head>

<body>
    <section>
        <h1>Create Discount</h1>
        <form onsubmit="event.preventDefault(); saveDiscount();">
            <!-- Các trường nhập liệu -->
            <section>
                <label for="code">Code</label>
                <input type="text" id="code" name="code" placeholder="Coupon Code" required>
            </section>

            <section>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Coupon Code Name" required>
            </section>

            <section>
                <label for="maxUses">Max Uses</label>
                <input type="number" id="maxUses" name="maxUses" placeholder="Max Uses" required>
            </section>

            <section>
                <label for="maxUsesUser">Max Uses Per User</label>
                <input type="number" id="maxUsesUser" name="maxUsesUser" placeholder="Max Uses User" required>
            </section>

            <section>
                <label for="type">Type</label>
                <select id="type" name="type">
                    <option value="percent">Percent</option>
                    <option value="fixed">Fixed Amount</option>
                </select>
            </section>

            <section>
                <label for="discountAmount">Discount Amount</label>
                <input type="number" id="discountAmount" name="discountAmount" placeholder="Discount Amount" required>
            </section>

            <section>
                <label for="minAmount">Min Amount</label>
                <input type="number" id="minAmount" name="minAmount" placeholder="Min Amount">
            </section>

            <section>
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </section>

            <section>
                <label for="startsAt">Starts At</label>
                <input type="datetime-local" id="startsAt" name="startsAt" required>
            </section>

            <section>
                <label for="expiresAt">Expires At</label>
                <input type="datetime-local" id="expiresAt" name="expiresAt" required>
            </section>

            <section class="full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description"></textarea>
            </section>

            <button type="submit">Save Discount</button>
        </form>
    </section>
</body>

</html>