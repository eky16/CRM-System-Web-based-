<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hitung status follow up berbasis hari kerja
 *
 * RULE:
 * - NORMAL  : sebelum H-1
 * - KUNING  : H-1, H, Sabtu/Minggu setelah H
 * - MERAH   : hari kerja pertama setelah follow up
 */
function hitungStatusFollowUp(DateTime $followUp, DateTime $today)
{
    // Normalisasi jam
    $followUp->setTime(0,0,0);
    $today->setTime(0,0,0);

    // H-1
    $hMinus1 = (clone $followUp)->modify('-1 day');

    // Cari hari kerja pertama setelah follow up
    $firstWorkdayAfter = clone $followUp;
    do {
        $firstWorkdayAfter->modify('+1 day');
    } while ($firstWorkdayAfter->format('N') >= 6); // 6=Sabtu,7=Minggu

    // 🔴 MERAH
    if ($today >= $firstWorkdayAfter) {
        return [
            'status' => 'overdue',
            'class'  => 'bg-overdue',
            'icon'   => '<i class="fa-solid fa-triangle-exclamation warning-icon"
                        title="Overdue, follow up terlewat"></i>'
        ];
    }

    // 🟡 KUNING (H-1, H, atau weekend setelah H)
    if ($today >= $hMinus1 && $today < $firstWorkdayAfter) {
        return [
            'status' => 'warning',
            'class'  => 'bg-warning',
            'icon'   =>  '<i class="fa-solid fa-triangle-exclamation warning-icon"
                        title="H-1 / Hari H follow up"></i>'
        ];
    }

    // 🟢 NORMAL (masih lama)
    return [
        'status' => 'normal',
        'class'  => '',
        'icon'   => ''
    ];
}
