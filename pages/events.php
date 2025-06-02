<?php

$upcoming_events = [];
$result1 = $db->query("
    SELECT * FROM events 
    WHERE event_date >= CURDATE() 
    ORDER BY event_date ASC 
    LIMIT 5
");

if ($result1) {
    while ($row = $result1->fetch_assoc()) {
        $upcoming_events[] = $row;
    }
}

// --- Past Events ---
$past_events = [];
$result2 = $db->query("
    SELECT * FROM events 
    WHERE event_date < CURDATE() 
    ORDER BY event_date DESC 
    LIMIT 6
");

if ($result2) {
    while ($row = $result2->fetch_assoc()) {
        $past_events[] = $row;
    }
}
?>
<?php
// Fetch Upcoming Events
$upcoming_events = [];
$result1 = $db->query("
    SELECT * FROM events 
    WHERE event_date >= CURDATE() 
    ORDER BY event_date ASC 
    LIMIT 5
");
if ($result1) {
    while ($row = $result1->fetch_assoc()) {
        $upcoming_events[] = $row;
    }
}

// Fetch Past Events
$past_events = [];
$result2 = $db->query("
    SELECT * FROM events 
    WHERE event_date < CURDATE() 
    ORDER BY event_date DESC 
    LIMIT 6
");
if ($result2) {
    while ($row = $result2->fetch_assoc()) {
        $past_events[] = $row;
    }
}

// Optionally define SITE_URL if it's not already
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/drought_prediction'); // adjust as needed
}
?>

<div class="page-header">
    <h1>Events</h1>
    <p>Conferences, workshops, and seminars on drought prediction</p>
</div>

<section class="upcoming-events">
    <h2>Upcoming Events</h2>
    <div class="events-timeline">
        <?php foreach ($upcoming_events as $event): ?>
            <div class="event-card">
                <div class="event-date">
                    <span class="day"><?php echo date('d', strtotime($event['event_date'])); ?></span>
                    <span class="month"><?php echo date('M', strtotime($event['event_date'])); ?></span>
                </div>
                <div class="event-details">
                    <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                    <div class="event-meta">
                        <span><i class="fas fa-clock"></i> <?php echo date('g:i A', strtotime($event['event_time'])); ?></span>
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></span>
                    </div>
                    <p><?php echo htmlspecialchars($event['description']); ?></p>
                    <?php if (!empty($event['registration_link'])): ?>
                        <a href="<?php echo htmlspecialchars($event['registration_link']); ?>" 
                           class="btn btn-primary" target="_blank">
                            Register Now
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="past-events">
    <h2>Past Events</h2>
    <div class="events-grid">
        <?php foreach ($past_events as $event): ?>
            <div class="past-event-card">
                <?php if (!empty($event['image_path'])): ?>
                    <div class="event-image">
                        <img src="<?php echo SITE_URL . '/assets/uploads/events/' . $event['image_path']; ?>" 
                             alt="<?php echo htmlspecialchars($event['title']); ?>"
                             loading="lazy">
                    </div>
                <?php endif; ?>
                <div class="event-content">
                    <div class="event-date">
                        <?php echo date('F j, Y', strtotime($event['event_date'])); ?>
                    </div>
                    <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                    <p><?php echo substr(htmlspecialchars($event['description']), 0, 100) . '...'; ?></p>
                    <?php if (!empty($event['gallery_link'])): ?>
                        <a href="<?php echo htmlspecialchars($event['gallery_link']); ?>" 
                           class="view-gallery">
                            View Gallery <i class="fas fa-images"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
