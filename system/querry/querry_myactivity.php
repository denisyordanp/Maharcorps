<?php
    $querrymyactivity="SELECT id_participant, account.id_account, activity.id_activity, activity.activity_name, activity.activity_name, DAY(activity.activity_date), MONTH(activity.activity_date), YEAR(activity.activity_date), activity.activity_end, activity.activity_type, activity.activity_location, participant_payment_status, DAY(participant_registration_date), MONTH(participant_registration_date), YEAR(participant_registration_date) FROM participant
    INNER JOIN activity ON activity.id_activity=participant.id_activity
    INNER JOIN account ON account.id_account=participant.id_account WHERE id_activity = '$id_activity'";
?>