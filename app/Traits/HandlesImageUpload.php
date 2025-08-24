<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUpload
{
    /**
     * Optimise et sauvegarde une image uploadée
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param int $maxWidth
     * @param int $maxHeight
     * @param int $quality
     * @return string Le chemin de l'image sauvegardée
     */
    protected function optimizeAndStoreImage(
        UploadedFile $file, 
        string $directory, 
        int $maxWidth = 800, 
        int $maxHeight = 800, 
        int $quality = 85
    ): string {
        // Générer un nom unique pour le fichier
        $filename = uniqid() . '_' . time() . '.jpg';
        $fullPath = $directory . '/' . $filename;
        
        // Traiter l'image avec Intervention Image
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());
        
        // Redimensionner si nécessaire en gardant les proportions
        if ($image->width() > $maxWidth || $image->height() > $maxHeight) {
            $image->scaleDown(width: $maxWidth, height: $maxHeight);
        }
        
        // Convertir en JPEG avec compression optimale
        $optimizedImage = $image->toJpeg($quality);
        
        // Sauvegarder dans le storage
        Storage::put($fullPath, $optimizedImage->toString());
        
        return $fullPath;
    }
    
    /**
     * Supprime une image du storage si elle existe
     *
     * @param string|null $imagePath
     * @return void
     */
    protected function deleteImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
    
    /**
     * Optimise une image de profil utilisateur (format carré)
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function optimizeProfilePicture(UploadedFile $file): string
    {
        return $this->optimizeAndStoreImage($file, 'profile-pictures', 300, 300, 90);
    }
    
    /**
     * Optimise une image d'espace (format paysage)
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function optimizeEspaceImage(UploadedFile $file): string
    {
        return $this->optimizeAndStoreImage($file, 'espaces', 1200, 800, 85);
    }
    
    /**
     * Optimise une image d'article (format paysage)
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function optimizeArticleImage(UploadedFile $file): string
    {
        return $this->optimizeAndStoreImage($file, 'articles', 1200, 600, 85);
    }
    
    /**
     * Optimise une image d'événement (format paysage)
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function optimizeEventImage(UploadedFile $file): string
    {
        return $this->optimizeAndStoreImage($file, 'events', 1200, 600, 85);
    }
}