<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("INSERT INTO `detail_keluarga` (`id_keluarga`, `id_penduduk`, `peran_keluarga`, `created_at`, `updated_at`) VALUES
(1, 5, 'Kepala Keluarga', '2024-06-06 03:51:40', '2024-06-06 03:51:40'),
(1, 4, 'Anak', '2024-06-06 03:51:40', '2024-06-06 03:51:40'),
(1, 6, 'Istri', '2024-06-06 03:51:40', '2024-06-06 03:51:40'),
(2, 10, 'Kepala Keluarga', '2024-06-06 03:57:17', '2024-06-06 03:57:17'),
(2, 9, 'Istri', '2024-06-06 03:57:17', '2024-06-06 03:57:17'),
(2, 7, 'Anak', '2024-06-06 03:57:17', '2024-06-06 03:57:17'),
(2, 8, 'Anak', '2024-06-06 03:57:17', '2024-06-06 03:57:17'),
(3, 12, 'Kepala Keluarga', '2024-06-06 04:22:34', '2024-06-06 04:22:34'),
(3, 11, 'Istri', '2024-06-06 04:22:34', '2024-06-06 04:22:34'),
(5, 13, 'Kepala Keluarga', '2024-06-06 04:26:19', '2024-06-06 04:26:19'),
(4, 1, 'Kepala Keluarga', '2024-06-06 04:27:39', '2024-06-06 04:27:39'),
(4, 2, 'Anak', '2024-06-06 04:27:39', '2024-06-06 04:27:39'),
(6, 15, 'Kepala Keluarga', '2024-06-06 04:32:08', '2024-06-06 04:32:08'),
(6, 14, 'Istri', '2024-06-06 04:32:08', '2024-06-06 04:32:08'),
(6, 16, 'Istri', '2024-06-06 04:32:08', '2024-06-06 04:32:08'),
(6, 17, 'Istri', '2024-06-06 04:32:08', '2024-06-06 04:32:08'),
(7, 18, 'Kepala Keluarga', '2024-06-06 04:36:18', '2024-06-06 04:36:18'),
(7, 19, 'Istri', '2024-06-06 04:36:18', '2024-06-06 04:36:18'),
(7, 20, 'Anak', '2024-06-06 04:36:18', '2024-06-06 04:36:18'),
(7, 21, 'Anak', '2024-06-06 04:36:18', '2024-06-06 04:36:18'),
(7, 22, 'Anak', '2024-06-06 04:36:18', '2024-06-06 04:36:18'),
(7, 23, 'Anak', '2024-06-06 04:36:18', '2024-06-06 04:36:18'),
(8, 44, 'Kepala Keluarga', '2024-06-06 04:48:04', '2024-06-06 04:48:04'),
(8, 43, 'Istri', '2024-06-06 04:48:04', '2024-06-06 04:48:04'),
(8, 45, 'Anak', '2024-06-06 04:48:04', '2024-06-06 04:48:04'),
(8, 62, 'Anak', '2024-06-06 04:48:04', '2024-06-06 04:48:04'),
(9, 46, 'Kepala Keluarga', '2024-06-06 04:49:29', '2024-06-06 04:49:29'),
(9, 47, 'Istri', '2024-06-06 04:49:29', '2024-06-06 04:49:29'),
(9, 48, 'Anak', '2024-06-06 04:49:29', '2024-06-06 04:49:29'),
(9, 49, 'Anak', '2024-06-06 04:49:29', '2024-06-06 04:49:29'),
(10, 50, 'Kepala Keluarga', '2024-06-06 04:50:25', '2024-06-06 04:50:25'),
(10, 51, 'Istri', '2024-06-06 04:50:25', '2024-06-06 04:50:25'),
(11, 52, 'Kepala Keluarga', '2024-06-06 04:52:58', '2024-06-06 04:52:58'),
(12, 54, 'Kepala Keluarga', '2024-06-06 04:54:55', '2024-06-06 04:54:55'),
(12, 53, 'Istri', '2024-06-06 04:54:55', '2024-06-06 04:54:55'),
(12, 55, 'Anak', '2024-06-06 04:54:55', '2024-06-06 04:54:55'),
(13, 56, 'Kepala Keluarga', '2024-06-06 04:56:15', '2024-06-06 04:56:15'),
(13, 57, 'Istri', '2024-06-06 04:56:15', '2024-06-06 04:56:15'),
(14, 60, 'Kepala Keluarga', '2024-06-06 04:57:18', '2024-06-06 04:57:18'),
(15, 61, 'Kepala Keluarga', '2024-06-06 04:57:46', '2024-06-06 04:57:46'),
(16, 63, 'Kepala Keluarga', '2024-06-06 05:55:51', '2024-06-06 05:55:51'),
(17, 3, 'Kepala Keluarga', '2024-06-06 05:56:40', '2024-06-06 05:56:40'),
(18, 58, 'Kepala Keluarga', '2024-06-06 05:57:33', '2024-06-06 05:57:33'),
(18, 59, 'Istri', '2024-06-06 05:57:33', '2024-06-06 05:57:33'),
(19, 65, 'Kepala Keluarga', '2024-06-06 05:59:16', '2024-06-06 05:59:16'),
(19, 64, 'Anak', '2024-06-06 05:59:16', '2024-06-06 05:59:16'),
(19, 66, 'Anak', '2024-06-06 05:59:16', '2024-06-06 05:59:16'),
(20, 68, 'Kepala Keluarga', '2024-06-06 06:00:20', '2024-06-06 06:00:20'),
(20, 67, 'Istri', '2024-06-06 06:00:20', '2024-06-06 06:00:20'),
(21, 69, 'Kepala Keluarga', '2024-06-06 06:01:10', '2024-06-06 06:01:10'),
(22, 70, 'Kepala Keluarga', '2024-06-06 06:01:49', '2024-06-06 06:01:49'),
(23, 71, 'Kepala Keluarga', '2024-06-06 06:02:24', '2024-06-06 06:02:24'),
(24, 72, 'Kepala Keluarga', '2024-06-06 06:03:05', '2024-06-06 06:03:05'),
(25, 73, 'Kepala Keluarga', '2024-06-06 06:03:48', '2024-06-06 06:03:48'),
(25, 74, 'Anak', '2024-06-06 06:03:48', '2024-06-06 06:03:48'),
(26, 75, 'Kepala Keluarga', '2024-06-06 06:05:06', '2024-06-06 06:05:06'),
(26, 76, 'Anak', '2024-06-06 06:05:06', '2024-06-06 06:05:06'),
(27, 77, 'Kepala Keluarga', '2024-06-06 06:05:41', '2024-06-06 06:05:41'),
(28, 78, 'Kepala Keluarga', '2024-06-06 06:06:32', '2024-06-06 06:06:32'),
(28, 79, 'Anak', '2024-06-06 06:06:32', '2024-06-06 06:06:32'),
(29, 80, 'Kepala Keluarga', '2024-06-06 06:07:28', '2024-06-06 06:07:28'),
(30, 81, 'Kepala Keluarga', '2024-06-06 06:08:04', '2024-06-06 06:08:04'),
(30, 82, 'Anak', '2024-06-06 06:08:04', '2024-06-06 06:08:04'),
(31, 93, 'Kepala Keluarga', '2024-06-06 06:08:37', '2024-06-06 06:08:37'),
(31, 94, 'Anak', '2024-06-06 06:08:37', '2024-06-06 06:08:37'),
(32, 96, 'Kepala Keluarga', '2024-06-06 06:09:25', '2024-06-06 06:09:25'),
(32, 95, 'Anak', '2024-06-06 06:09:25', '2024-06-06 06:09:25'),
(33, 97, 'Kepala Keluarga', '2024-06-06 06:10:09', '2024-06-06 06:10:09'),
(33, 98, 'Anak', '2024-06-06 06:10:09', '2024-06-06 06:10:09'),
(34, 101, 'Kepala Keluarga', '2024-06-06 06:10:50', '2024-06-06 06:10:50'),
(34, 99, 'Istri', '2024-06-06 06:10:50', '2024-06-06 06:10:50'),
(34, 100, 'Anak', '2024-06-06 06:10:50', '2024-06-06 06:10:50');");
    }
}
