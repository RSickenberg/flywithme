# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
- Added toast notifications
- Added form to create a new flight
- Added Filament package suites

## [0.1.1] - 2022-11-02
### Changed
- Upgraded some Laravel dependencies

### Added
- Added flight legs count
- Flight seeds nows adds the flight times
- FlightController tests.

### Fixed
- Fixed relation with Flight -> FlightTime
- Fixed few code auto-generated not suitable for real usage.

## [0.1.0] - 2022-10-10
### Added
- Added database migrations
- Added factories
- Added Livewire with jetstream
- Added Flight Controller
- Added Flight Filters
- Tweaked some models with ULID primary keys

[Unreleased]: https://github.com/RSickenberg/flywithme/compare/v0.1.1...HEAD
[0.1.1]: https://github.com/RSickenberg/flywithme/compare/v0.1.0...v0.1.1
[0.1.0]: https://github.com/RSickenberg/flywithme/releases/tag/v0.1.0
