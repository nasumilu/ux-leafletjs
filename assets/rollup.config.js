import { babel } from '@rollup/plugin-babel';
import { nodeResolve } from '@rollup/plugin-node-resolve';

export default [
    {
        input: 'src/controller.js',
        output: {
            name: 'LeafletjsController',
            file: 'dist/controller.js',
            format: 'esm',
            sourcemap: false
        },
        external: [
            /@babel\/runtime/,
            /core-js\//,
            '@hotwired/stimulus',
            'leaflet'
        ],
        plugins: [
            babel({
                babelHelpers: 'runtime',
            }),
            nodeResolve()
        ]
    }
];
