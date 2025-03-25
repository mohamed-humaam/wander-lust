import './bootstrap';
import Alpine from 'alpinejs'
import Livewire from 'livewire-v2'
import FileUpload from '~/filament/forms/components/file-upload'
import RichEditor from '~/filament/forms/components/rich-editor'

window.Alpine = Alpine
window.Livewire = Livewire

Alpine.plugin(FileUpload)
Alpine.plugin(RichEditor)

Alpine.start()
