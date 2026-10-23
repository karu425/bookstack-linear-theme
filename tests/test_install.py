"""Behavior checks for refusing overwrites, retaining backups, and keeping core intact."""
import importlib.util
from pathlib import Path
import tempfile
import unittest

MODULE_PATH = Path(__file__).resolve().parents[1] / 'scripts/install.py'
SPEC = importlib.util.spec_from_file_location('theme_installer', MODULE_PATH)
MODULE = importlib.util.module_from_spec(SPEC)
SPEC.loader.exec_module(MODULE)


class InstallTests(unittest.TestCase):
    def setUp(self):
        self.temp = tempfile.TemporaryDirectory()
        self.root = Path(self.temp.name)
        self.themes = self.root / 'app/themes'
        self.themes.mkdir(parents=True)
        self.core = self.root / 'app/core.txt'
        self.core.write_text('unchanged')

    def tearDown(self):
        self.temp.cleanup()

    def test_new_install_is_isolated(self):
        target, backup = MODULE.install(self.themes)
        self.assertTrue((target / 'layouts/parts/custom-head.blade.php').exists())
        self.assertIsNone(backup)
        self.assertEqual(self.core.read_text(), 'unchanged')
        self.assertFalse((self.root / 'app/.env').exists())

    def test_existing_theme_requires_explicit_update_and_backup(self):
        target = self.themes / 'linear'
        target.mkdir()
        sentinel = target / 'existing.txt'
        sentinel.write_text('keep me')
        with self.assertRaises(ValueError):
            MODULE.install(self.themes)
        with self.assertRaises(ValueError):
            MODULE.install(self.themes, update=True)
        with self.assertRaises(ValueError):
            MODULE.install(self.themes, update=True, backup_dir=target / 'backup')
        self.assertEqual(sentinel.read_text(), 'keep me')

    def test_update_retains_complete_old_directory(self):
        target = self.themes / 'linear'
        target.mkdir()
        (target / 'existing.txt').write_text('old theme')
        installed, backup = MODULE.install(self.themes, update=True, backup_dir=self.root / 'backups')
        self.assertEqual((backup / 'existing.txt').read_text(), 'old theme')
        self.assertFalse((installed / 'existing.txt').exists())
        self.assertTrue((installed / 'layouts/parts/linear-styles.blade.php').exists())
        self.assertEqual(self.core.read_text(), 'unchanged')

    def test_symlink_destination_is_refused(self):
        other = self.root / 'other-theme'
        other.mkdir()
        (other / 'private.txt').write_text('untouched')
        (self.themes / 'linear').symlink_to(other, target_is_directory=True)
        with self.assertRaises(ValueError):
            MODULE.install(self.themes, update=True, backup_dir=self.root / 'backups')
        self.assertEqual((other / 'private.txt').read_text(), 'untouched')


if __name__ == '__main__':
    unittest.main()
