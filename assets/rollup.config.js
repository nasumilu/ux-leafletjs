import { babel } from '@rollup/plugin-babel';
import { nodeResolve } from '@rollup/plugin-node-resolve';

export default [
    {
        input: 'src/leaflet-controller.js',
        output: {
            name: 'LeafletController',
            file: 'dist/leaflet-controller.js',
            format: 'esm',
            sourcemap: false
        },
        external: [
            /@babel\/runtime/,
            /core-js\//,
            'stimulus',
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
