<?php
    header('Content-Type: application/javascript');
    include "../../../core/config.php";

    $q = $conn->query("
        select
            m.aed_location,
            m.aed_latitude,
            m.aed_longitude,
            m.aed_condition,
            case
                when m.aed_batterystatus like '%flat%' then 'battery_issue'
                when m.aed_batterystatus like '%empty%' then 'battery_issue'
                when m.aed_batterystatus like '%absent%' then 'battery_issue'
                when m.aed_batterystatus like '%does not%' then 'battery_issue'
                when isnull(pc.exp_early) then 'pads_unknown' 
                when pc.exp_late < curdate() then 'expired_pads'
                when pc.exp_early < curdate() and pc.exp_late > curdate() then 'some_expired_pads'
                else 'available'
            end as status,
            pc.exp_early,
            m.aed_batterystatus,
            case when m.box_rescuereadykit = 1 then 'Yes' else 'No' end as rescuereadykit
        from
            aed_machines as m
            left join (
                select
                    1 as available, 
                    m.aed_id
                from
                    aed_machines as m
                where
                    aed_time_mon_start = '00:00:00' and aed_time_mon_end = '23:59:00' and 
                    aed_time_tue_start = '00:00:00' and aed_time_tue_end = '23:59:00' and 
                    aed_time_wed_start = '00:00:00' and aed_time_wed_end = '23:59:00' and 
                    aed_time_thur_start = '00:00:00' and aed_time_thur_end = '23:59:00' and 
                    aed_time_fri_start = '00:00:00' and aed_time_fri_end = '23:59:00' and 
                    aed_time_sat_start = '00:00:00' and aed_time_sat_end = '23:59:00' and 
                    aed_time_sun_start = '00:00:00' and aed_time_sun_end = '23:59:00'
            ) as 24hr on m.aed_id = 24hr.aed_id
            left join (
                select aed_id, min(aed_pads_expiry) as exp_early, max(aed_pads_expiry) as exp_late from (
                select aed_id, aed_pads1_expiry as aed_pads_expiry, aed_pads1_type as aed_pads_type from `aed_machines` WHERE aed_pads1_expiry is not null union all
                select aed_id, aed_pads2_expiry, aed_pads2_type from aed_machines where aed_pads2_expiry is not null union all
                select aed_id, aed_pads3_expiry, aed_pads3_type from aed_machines where aed_pads3_expiry is not null union all
                select aed_id, aed_pads4_expiry, aed_pads4_type from aed_machines where aed_pads4_expiry is not null
                    ) as x
                group by aed_id
            ) as pc on pc.aed_id = m.aed_id
        where
            aed_geolocation is not null
            and not isnull(24hr.available)
        ");
?>
    const defibs = [
        <?php
        
        while($defib = $q->fetch_assoc()){
            $type = 'kit-medical';
            if($defib['status'] == "battery_issue") $type = 'battery-full';
            if($defib['status'] == "pads_unknown") $type = 'question';
            echo "{
                address: '".str_replace("\r","",str_replace("\n","",str_replace("'","\'",$defib['aed_location'])))."',
                position: {
                    lat: ".$defib['aed_latitude'].",
                    lng: ".$defib['aed_longitude'].",
                },
                type: '".$type."',
                description: '".str_replace("\r","",str_replace("\n","",str_replace("'","\'",$defib['aed_condition'])))."',
                status: '".$defib['status']."',
                pads_min: '".$defib['exp_early']."',
                battery_status: '".$defib['aed_batterystatus']."',
                rescue_ready_kit: '".$defib['rescuereadykit']."',

            },
            ";
        }

        ?>/*{
            address: '215 Emily St, MountainView, CA',
            description: 'Single family house with modern design',
            price: '$ 3,889,000',
            type: 'kit-medical',
            bed: 5,
            bath: 4.5,
            size: 300,
            position: {
                lat: 35.8308,
                lng: 14.4741,
            },
            status: 'available',
        },
        {
            address: '108 Squirrel Ln &#128063;, Menlo Park, CA',
            description: 'Townhouse with friendly neighbors',
            price: '$ 3,050,000',
            type: 'kit-medical',
            bed: 4,
            bath: 3,
            size: 200,
            position: {
                lat: 35.833,
                lng: 14.4727,
            },
            status: 'unavailable',
        },
        {
            address: '100 Chris St, Portola Valley, CA',
            description: 'Spacious warehouse great for small business',
            price: '$ 3,125,000',
            type: 'kit-medical',
            bed: 4,
            bath: 4,
            size: 800,
            position: {
                lat: 35.8422,
                lng: 14.4857,
            },
            status: 'broken',
        },*/
    ];