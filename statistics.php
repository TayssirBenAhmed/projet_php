<?php 


// Database connection
$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reviews from the database
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

// Define arrays for positive and negative reviews
$positive_reviews = [];
$negative_reviews = [];
$dates = [];

// Initialize counters for statistics
$emoji_count = [
    '😊' => 0, '❤️' => 0, '👍' => 0, 
    '😢' => 0, '😡' => 0, '👎' => 0
];

// Store reviews and group them by date
while ($row = $result->fetch_assoc()) {
    $date = isset($row['created_at']) ? date("Y-m-d", strtotime($row['created_at'])) : date("Y-m-d");
    $dates[] = $date;

    // Classify the review as positive or negative based on the emoji
    if (in_array($row['emoji'], ['😊', '❤️', '👍'])) {
        $positive_reviews[] = $row;
    } elseif (in_array($row['emoji'], ['😢', '😡', '👎'])) {
        $negative_reviews[] = $row;
    }

    // Count the occurrence of each emoji for statistics
    if (isset($emoji_count[$row['emoji']])) {
        $emoji_count[$row['emoji']]++;
    }
}

// Group reviews by date for histogram
$positive_by_date = array_count_values(array_map(function($review) {
    return date("Y-m-d", strtotime($review['created_at']));
}, $positive_reviews));

$negative_by_date = array_count_values(array_map(function($review) {
    return date("Y-m-d", strtotime($review['created_at']));
}, $negative_reviews));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Analyzer📉</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #8e44ad, #f39c12);
        color: #fff;
        margin: 0;
        padding: 0;
        overflow-x: hidden;}

        .container {
            max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        }

        header.page-header {
            text-align: center;
            background: linear-gradient(135deg, #6a0dad, #f39c12);
            padding: 20px;
            border-radius: 8px;
            color: white;
        }

        header.page-header h1 {
            font-size: 2.5em;
        }

        header.page-header .subheading {
            font-size: 1.2em;
            color: #f1f1f1;
        }

        .section {
            background-color: white;
            margin: 20px 0;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            color: #6a1b9a;
            font-size: 2em;
            margin-bottom: 10px;
            text-align: center;
        }

        .statistics-charts .chart {
            margin-top: 30px;
            text-align: center;
        }

        .statistics-charts canvas {
            max-width: 600px;
            margin: 0 auto;
        }

        .statistics-section button {
        background: linear-gradient(135deg, #6a0dad, #f39c12);
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 2em;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto;
        }

        .statistics-section button:hover {
            background-color:rgb(66, 26, 75);
        }

        .reviews-list ul {
            list-style-type: none;
            padding: 0;
        }

        .reviews-list li {
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
        }

        .positive {
            background-color: #d0f8ce;
            color: #2C6B2F;
        }

        .negative {
            background-color: #f8d0d0;
            color: #D32F2F;
        }

        /* Hidden charts initially */
        .statistics-charts canvas {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .section {
                padding: 20px;
            }
        }
        footer {
        text-align: center;
        padding: 2rem;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #6a0dad, #ff7f00);
        border-top: 2px solid #cc7a00;
        width: 100%;
    }

    footer a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: #fef9e7;
    }
    h3,p{
        color:black;
    }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <header class="page-header">
            <h1>Feedback Analyzer📉</h1>
            <p class="subheading">Review and analyze customer feedback to improve our services.</p>
        </header>

        <section class="section statistics-section">
            <h2>Review Overview🧠</h2>
            <p>Here we provide insights from the customer reviews received in the clinic. We analyze the sentiment of these reviews to ensure we are improving and addressing any concerns from our patients.</p>
            
            <!-- Button to show reviews -->
            <button class="btn btn-show-reviews" onclick="showReviews()">Show Detailed Reviews</button>

            <div class="statistics-charts">
                <div class="chart">
                    <h3>Positive vs Negative Reviews</h3>
                    <p>This pie chart represents the proportion of positive and negative reviews submitted by patients. A positive review corresponds to a smiley emoji or a thumbs-up, whereas negative reviews typically correspond to sad or angry emojis.</p>
                    <canvas id="review-sentiment-chart"></canvas>
                </div>
                <div class="chart">
                    <h3>Review Emoji Distribution</h3>
                    <p>This pie chart shows the distribution of emojis used in the reviews. Emojis like 😊, ❤️, and 👍 indicate positive feedback, while emojis like 😢, 😡, and 👎 represent negative feedback. This helps visualize the sentiment trends in the clinic's reviews.</p>
                    <canvas id="emoji-distribution-chart"></canvas>
                </div>
                <div class="chart">
                    <h3>Review Histogram: Positive vs Negative over Time</h3>
                    <p>The histogram shows the number of positive and negative reviews submitted over time. This graph helps visualize trends, such as if there were certain periods where positive or negative feedback was more prevalent.</p>
                    <canvas id="review-histogram-chart"></canvas>
                </div>
            </div>
            <button onclick="window.print()">Print</button>

        </section>

        <section class="section reviews-list">
            <h2>Detailed Reviews</h2>
            <ul>
                <?php foreach ($positive_reviews as $review): ?>
                <li class="positive">
                    <strong><?php echo $review['name']; ?></strong>
                    <em><?php echo $review['emoji']; ?></em>
                    <p><?php echo $review['review_text']; ?></p>
                    <small>Reviewed on: <?php echo $review['created_at']; ?></small>
                </li>
                <?php endforeach; ?>
                <?php foreach ($negative_reviews as $review): ?>
                <li class="negative">
                    <strong><?php echo $review['name']; ?></strong>
                    <em><?php echo $review['emoji']; ?></em>
                    <p><?php echo $review['review_text']; ?></p>
                    <small>Reviewed on: <?php echo $review['created_at']; ?></small>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>

    <script>
        function showReviews() {
            document.querySelectorAll('.statistics-charts canvas').forEach((canvas) => {
                canvas.style.display = 'block';  
            });
            renderCharts();
        }

        function renderCharts() {
            const emojiData = <?php echo json_encode($emoji_count); ?>;
            const positiveCount = <?php echo count($positive_reviews); ?>;
            const negativeCount = <?php echo count($negative_reviews); ?>;
            const positiveByDate = <?php echo json_encode($positive_by_date); ?>;
            const negativeByDate = <?php echo json_encode($negative_by_date); ?>;

            new Chart(document.getElementById('review-sentiment-chart'), {
                type: 'pie',
                data: {
                    labels: ['Positive Reviews', 'Negative Reviews'],
                    datasets: [{
                        data: [positiveCount, negativeCount],
                        backgroundColor: ['#2C6B2F', '#D32F2F'],
                    }]
                },
                options: { responsive: true }
            });

            // Emoji Distribution Chart (Pie chart)
            new Chart(document.getElementById('emoji-distribution-chart'), {
                type: 'pie',
                data: {
                    labels: ['😊', '❤️', '👍', '😢', '😡', '👎'],
                    datasets: [{
                        label: 'Review Emoji Distribution',
                        data: [emojiData['😊'], emojiData['❤️'], emojiData['👍'], emojiData['😢'], emojiData['😡'], emojiData['👎']],
                        backgroundColor: ['#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236', '#ff5733'],
                    }]
                },
                options: { responsive: true }
            });

            // Review Histogram (Bar Chart)
            new Chart(document.getElementById('review-histogram-chart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(positiveByDate), // Dates for histogram
                    datasets: [{
                        label: 'Positive Reviews',
                        data: Object.values(positiveByDate),
                        backgroundColor: '#2C6B2F',
                    }, {
                        label: 'Negative Reviews',
                        data: Object.values(negativeByDate),
                        backgroundColor: '#D32F2F',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: { 
                            beginAtZero: true 
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
<?php include('footer.php'); ?>

