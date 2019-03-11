<?php
    $querryparticipant="SELECT id_participant, account.id_account, account.account_name, activity.id_activity, activity.activity_name, participant_payment_status, DAY(participant_registration_date), MONTH(participant_registration_date), YEAR(participant_registration_date) FROM participant
    INNER JOIN activity ON activity.id_activity=participant.id_activity
    INNER JOIN account ON account.id_account=participant.id_account WHERE id_activity = '$id_activity'";
?>