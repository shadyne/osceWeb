<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function status_color($s)
{
    static $map = [
        'draft'       => 'default',
        'aktif'       => 'success',
        'selesai'     => 'primary',
        'belum'       => 'warning',
        'mengerjakan' => 'info',
    ];
    return $map[$s] ?? 'default';
}

function fmt_tgl($d, $fmt = 'd-m-Y')
{
    return $d ? date($fmt, strtotime($d)) : '-';
}

function e($s)
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}
