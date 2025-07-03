<?php
class CertificateGenerator
{
    private string $templatePath;
    private string $fontNamePath;
    private string $fontOccupationPath;
    private string $outputDir;

    public function __construct()
    {
        $this->templatePath = __DIR__ . '/../assets/images/certi.png';
        $this->fontNamePath = __DIR__ . '/../assets/fonts/developer.ttf';
        $this->fontOccupationPath = __DIR__ . '/../assets/fonts/Gotham-Black.otf';
        $this->outputDir = __DIR__ . '/../public/generated/';
        if (!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0777, true);
        }
    }

    /**
     * @param string $name
     * @param string $occupation
     * @return array{image: string, name: string}
     * @throws Exception
     */
    public function generate(string $name, string $occupation): array
    {
        $name = trim($name);
        $occupation = trim($occupation);
        if ($name === '' || $occupation === '') {
            throw new Exception('Ensure you fill all the fields!');
        }
        $name = strtoupper($name);
        $occupation = strtoupper($occupation);
        $name_len = strlen($name);
        $font_size_occupation = 10;
        $rotation = 0;
        $origin_x = 200;
        $origin_y = 260;
        $origin1_x = 120;
        $origin1_y = 90;
        if ($name_len <= 7) {
            $font_size = 25;
            $origin_x = 190;
        } elseif ($name_len <= 12) {
            $font_size = 30;
        } elseif ($name_len <= 15) {
            $font_size = 26;
        } elseif ($name_len <= 20) {
            $font_size = 18;
        } elseif ($name_len <= 22) {
            $font_size = 15;
        } elseif ($name_len <= 33) {
            $font_size = 11;
        } else {
            $font_size = 10;
        }
        if (!file_exists($this->templatePath) || !file_exists($this->fontNamePath) || !file_exists($this->fontOccupationPath)) {
            throw new Exception('Required asset missing (template or font).');
        }
        $createimage = imagecreatefrompng($this->templatePath);
        if (!$createimage) {
            throw new Exception('Failed to load certificate template image.');
        }
        $black = imagecolorallocate($createimage, 0, 0, 0);
        imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $black, $this->fontNamePath, $name);
        imagettftext($createimage, $font_size_occupation, $rotation, $origin1_x + 2, $origin1_y, $black, $this->fontOccupationPath, $occupation);
        $outputFile = $this->outputDir . 'certificate_' . time() . '_' . rand(1000,9999) . '.png';
        imagepng($createimage, $outputFile, 3);
        imagedestroy($createimage);
        $publicPath = 'generated/' . basename($outputFile);
        return [
            'image' => $publicPath,
            'name' => $name
        ];
    }
} 