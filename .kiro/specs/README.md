# Project Steering Specifications

This directory contains high-level architectural decisions and technical direction for the project.

## Active Specifications

### [HTMX Integration](./htmx-integration.md)
**Status:** Active  
**Priority:** High  
**Summary:** Progressive adoption of HTMX for dynamic interactions, moving toward hypermedia-driven architecture. Replaces full-page reloads with partial HTML updates for better UX and performance.

### [HTMX Migration Project](./htmx-migration-project.md)
**Status:** Planning  
**Priority:** High  
**Summary:** Detailed migration plan to replace 180+ lines of vanilla JavaScript DOM manipulation with HTMX attributes. Targets 16 templates with CRUD operations, filtering, and form enhancements. Estimated 89% code reduction.

---

## Purpose

Steering specs define:
- Technology choices and rationale
- Implementation patterns and guidelines
- Migration strategies
- Success criteria

These are living documents that evolve as the project grows.
